<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use App\Models\AttestationInscriptionModel;
use App\Models\StudentModel;
use App\Models\SettingsModel;
use CodeIgniter\Controller;
use App\Models\CourseModel; 
use App\Models\EnrollmentModel ; 


class StudentController extends Controller
{
    // Show the form to add a student
    public function create()
    {
        $model = new CourseModel();
        $courses = $model ->findAll();
        return view('add_student', ['courses' => $courses]);
    }
    public function profile($id)
{
    $model = new StudentModel();
    $attestationModel = new AttestationInscriptionModel();
    // Fetch student details by ID
    $student = $model->find($id);
    
    if (!$student) {
        return redirect()->to('/students/manage')->with('error', 'Student not found');
    }
    $attestation = $attestationModel->where('student_id', $id)->first();

    // Pass the student data to the view
    return view('student_profile', ['student' => $student,
    'attestation' => $attestation

]);
}

    public function manageStudents()
    {
        $model = new StudentModel();
        
        // Fetch all students from the database
        $data['students'] = $model->findAll();  // Fetches all students
        
        // Pass the students data to the view
        return view('manage_students', $data);
    }
    public function edit($id)
    {
        $model = new StudentModel();
        
        // Fetch the student's data based on the student ID
        $student = $model->find($id);

        // Check if student exists
        if (!$student) {
            return redirect()->to('students/manage')->with('error', 'Student not found');
        }

        // Pass the student data to the edit view
        return view('edit_student', ['student' => $student]);
    }

    // Handle the form submission and update student data in the database
    public function update($id)
    {
        $model = new StudentModel();

        // Get the input data from the form
        $data = [
            'fullname'      => $this->request->getPost('fullname'),
            'dob'           => $this->request->getPost('dob'),
            'email'         => $this->request->getPost('email'),
            'contact_number'=> $this->request->getPost('contact_number'),
            'address'       => $this->request->getPost('address'),
        ];

        // Handle the file upload for photo (optional)
        $file = $this->request->getFile('photo');
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the uploaded photo to the public/images/ folder
            $uploadPath = FCPATH . 'images';
            $file->move($uploadPath, $file->getName());
            $data['photo'] = $file->getName();
        }

        // Update the student record
        $model->update($id, $data);

        // Redirect to the students page with a success message
        return redirect()->to('/students/manage')->with('message', 'Student updated successfully');}
    // Handle the form submission and add a student to the database
    public function store()
    {
        $model = new StudentModel();
        $userModel = auth()->getProvider(); // Shield's User Provider
    
        // Begin transaction
        $db = \Config\Database::connect();
        $db->transBegin();
    
        try {
            // Get the input data from the form
            $data = [
                'fullname'      => $this->request->getPost('fullname'),
                'dob'           => $this->request->getPost('dob'),
                'email'         => $this->request->getPost('email'),
                'contact_number'=> $this->request->getPost('contact_number'),
                'address'       => $this->request->getPost('address'),
                'photo'         => $this->request->getPost('photo')  // Optionally handle file uploads
            ];
    
            $photo = $this->request->getFile('photo');
            if ($photo->isValid() && !$photo->hasMoved()) {
                // Define the path to store the file in the 'public/uploads/images' directory
                $uploadPath = FCPATH . 'images';
                $photo->move($uploadPath, $photo->getName());  // If you're still using the writable folder for temporary storage
                $data['photo'] = $photo->getName();  // Store the file name in the database
            }
    
            // Generate username and password
            $name = $data['fullname'];
            $email = strtolower(str_replace(' ', '.', $name)) . '@example.com'; // e.g., john.doe@example.com
            $randomNumber = rand(1000, 9999); // Generate a 4-digit random number
            $username = strtolower(str_replace(' ', '_', $name)) . '_' . $randomNumber ; // e.g., john_doe_567812345678
            $password = bin2hex(random_bytes(4)); // Generate an 8-character random password
    
            // Create user
            $user = new \CodeIgniter\Shield\Entities\User([
                'username' => $username,
                'email'    => $email,
                'password' => $password, // Shield will hash this automatically
            ]);
    
            // Save the user
            $userModel->save($user);
            $userId = $userModel->getInsertID();

            // Retrieve the user to get the ID
            $user = $userModel->findById($userModel->getInsertID());
    
            // Add user to the default group
            $userModel->addToDefaultGroup($user);
    
            // Save the student data and link to the user ID
            $data['user_id'] = $userId; // Link user to student

            $studentId = $model->insert($data);
    
            if($studentId) {
                $attestationModel = new \App\Models\AttestationInscriptionModel();
                $attestationModel->insert([
                    'student_id'=> $studentId,
                    'email'     => $email,
                    'password'  => $password, // Optionally store this if it's not sensitive
                    'created_at'=> date('Y-m-d H:i:s'),
                ]);
                $courseId = $this->request->getPost('course_id');
                $duration = $this->request->getPost('duration');
                $course = $this->getCourseById($courseId);
                $amountPaid = $course['price'] * $duration;
    
                // Save the enrollment
                $enrollModel = new EnrollmentModel();
                $enrollModel->save([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'duration' => $duration,
                    'amount_paid' => $amountPaid,
                    'expiry_date' => date('Y-m-d', strtotime("+" . $duration . " months"))
                ]);
    
                // Commit transaction
                $db->transCommit();
                session()->setFlashdata('message', 'Student added successfully');
            } else {
                // Rollback transaction if something went wrong
                $db->transRollback();
                session()->setFlashdata('message', 'There was an error adding the student');
            }
    
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            $db->transRollback();
            session()->setFlashdata('message', 'An error occurred: ' . $e->getMessage());
        }
    
        // Redirect or return a success message
        return redirect()->to('student/create')->with('message', 'Student added successfully');
    }
    
    
    public function renew()
{
    $studentModel = new StudentModel();
    $enrollmentModel = new EnrollmentModel();
    $courseModel = new CourseModel();

    // Fetch all students with their courses
    $students = $studentModel->findAll();

    foreach ($students as &$student) {
        $enrollments = $enrollmentModel->where('student_id', $student['id'])->findAll();
        $student['courses'] = [];

        foreach ($enrollments as $enrollment) {
            $course = $courseModel->find($enrollment['course_id']);
            $status = (strtotime($enrollment['expiry_date']) >= time()) ? 'Active' : 'Expired';

            $student['courses'][] = [
                'course_id'    => $enrollment['course_id'],
                'course_name'  => $course['course_name'],
                'expiry_date'  => $enrollment['expiry_date'],
                'status'       => $status,
                'enrollment_id'=> $enrollment['id']
            ];
        }
    }

    return view('renew', ['students' => $students]);
}
    private function getCourseById($id)
    {
        $courseModel = new CourseModel();
        return $courseModel->find($id);
    }
    public function delete($id)
    {
        $model = new StudentModel();

        // Check if the student exists before trying to delete
        $student = $model->find($id);

        if (!$student) {
            return redirect()->to('/students/manage')->with('error', 'Student not found');
        }

        // Delete the student's photo if it exists
        if (!empty($student['photo'])) {
            $photoPath = FCPATH . 'images/' . $student['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath); // Delete the file from the server
            }
        }

        // Delete the student record from the database
        $model->delete($id);

        // Redirect back to the students list with a success message
        return redirect()->to('/students/manage')->with('message', 'Student deleted successfully');
    }
    public function printCard($id)
{
    $settingsModel = new SettingsModel();
    $enrollmentModel = new EnrollmentModel();
    $courseModel = new CourseModel();
    $model = new StudentModel();
    $student = $model->find($id);
    $settings = $settingsModel->first(); // Fetch the settings (assuming only one row exists)

    if (!$student) {
        return redirect()->to('/students/manage')->with('error', 'Student not found');
    }
    $enrollments = $enrollmentModel->where('student_id', $id)->findAll();
    $courses = [];
    foreach ($enrollments as $enrollment) {
        $course = $courseModel->find($enrollment['course_id']);
        if ($course) {
            $courses[] = [
                'course_name' => $course['course_name'],
                'amount_paid' => $enrollment['amount_paid'],
                'expiry_date' => $enrollment['expiry_date']
            ];
        }
    }
    return view('student_card', [
        'student' => $student,
        'system_name' => $settings['system_name'],
        'logo' => $settings['logo'],
        'courses' => $courses
    ]);
}
}