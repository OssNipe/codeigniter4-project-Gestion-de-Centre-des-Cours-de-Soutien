<?php

namespace App\Controllers;

use App\Models\StudentModel;
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
    
    // Fetch student details by ID
    $student = $model->find($id);
    
    if (!$student) {
        return redirect()->to('/students/manage')->with('error', 'Student not found');
    }
    
    // Pass the student data to the view
    return view('student_profile', ['student' => $student]);
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

        // Get the input data from the formF
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
        $studentId = $model->insert($data);
        if($studentId){
            $courseId = $this->request->getPost('course_id');
            $duration = $this->request->getPost('duration');
            $course = $this->getCourseById($courseId);
            $amountPaid = $course['price'] * $duration;
            $enrollModel = new EnrollmentModel();
            $enrollModel->save([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'duration' => $duration,
                'amount_paid' => $amountPaid,
                'expiry_date' => date('Y-m-d', strtotime("+" . $duration . " months"))
            ]);
            session()->setFlashdata('message', 'Student added successfully');

        } else {
            // Handle the case when saving fails (optional)
            session()->setFlashdata('message', 'There was an error adding the student');
        }
        // Insert data into the students table
        
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
    $model = new StudentModel();
    $student = $model->find($id);

    if (!$student) {
        return redirect()->to('/students')->with('error', 'Student not found');
    }

    return view('student_card', ['student' => $student]);
}
}
