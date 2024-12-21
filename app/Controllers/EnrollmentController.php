<?php
namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\RenewalModel;

use CodeIgniter\Controller;

class EnrollmentController extends Controller
{
    // Show the form to add a new enrollment for an existing student
    public function addEnrollment($studentId)
    {
        $studentModel = new StudentModel();
        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        // Fetch the student details
        $student = $studentModel->find($studentId);
        if (!$student) {
            return redirect()->to('/students/manage')->with('error', 'Student not found.');
        }

        // Fetch all courses
        $courses = $courseModel->findAll();

        // Get all courses the student is currently enrolled in
        $enrolledCourses = $enrollmentModel->where('student_id', $studentId)
                                           ->findAll();

        // Extract the course IDs the student is already enrolled in
        $enrolledCourseIds = array_map(function($enrollment) {
            return $enrollment['course_id'];
        }, $enrolledCourses);

        // Filter out the courses the student is already enrolled in
        $availableCourses = array_filter($courses, function($course) use ($enrolledCourseIds) {
            return !in_array($course['id'], $enrolledCourseIds);
        });

        return view('add_enrollment', [
            'student' => $student,
            'courses' => $availableCourses
        ]);
    }

    // Store the enrollment details in the database
    public function storeEnrollment()
    {
        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        // Get form data
        $course_id = $this->request->getPost('course_id');
        $duration = $this->request->getPost('duration');
        $course = $courseModel->find($course_id);
        $amount_paid = $course['price'] * $duration;

        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'course_id' =>  $course_id,
            'duration' =>   $duration,
            'amount_paid' => $amount_paid,
            'expiry_date' => date('Y-m-d', strtotime("+$duration months")),
        ];

        $enrollmentModel->insert($data);

        return redirect()->to('/student/renew')->with('message', 'Enrollment added successfully.');
    }
    // In EnrollmentController.php
    public function renew($student_id)
    {
        // Get student data
        $studentModel = new StudentModel();
        $student = $studentModel->find($student_id);
    
        // Get the student's current enrollments, including course names
        $enrollmentModel = new EnrollmentModel();
        $enrollments = $enrollmentModel->where('student_id', $student_id)->findAll();
    
        // Get all courses to use course name in the view
        $courseModel = new CourseModel();
    
        // Fetch course names by course_id from enrollments
        foreach ($enrollments as &$enrollment) {
            $course = $courseModel->find($enrollment['course_id']);
            $enrollment['course_name'] = $course ? $course['course_name'] : 'Course Not Found';
        }
    
        // Pass the data to the view
        return view('renew_subscriptions', [
            'student' => $student,
            'enrollments' => $enrollments,
        ]);
    }
// In EnrollmentController.php

public function storeRenewal($student_id)
{
    $enrollmentModel = new EnrollmentModel();
    $renewalModel = new RenewalModel(); // Assuming you have a model for the 'renewals' table
    $courseModel = new CourseModel(); // Assuming you have a model for the 'courses' table

    // Get form data
    $enrollment_id = $this->request->getPost('enrollment_id');
    $renew_duration = $this->request->getPost('renew_duration');

    // Fetch the enrollment record
    $enrollment = $enrollmentModel->find($enrollment_id);

    if ($enrollment) {
        // Calculate the new expiry date
        $course = $courseModel->find($enrollment['course_id']);
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }
        $renewal_amount = $course['price'] * $renew_duration;

        $new_expiry_date = date('Y-m-d', strtotime($enrollment['expiry_date'] . " +$renew_duration months"));

        // Calculate the renewal amount based on course price and renewal duration
        $courseModel = new CourseModel();
        $course = $courseModel->find($enrollment['course_id']);
        $renewal_amount = $course['price'] * $renew_duration;

        // Update the enrollment record with the new expiry date and duration
        $data = [
            'expiry_date' => $new_expiry_date,
            'duration' => $enrollment['duration'] + $renew_duration, 
            'amount_paid' => $enrollment['amount_paid'] + $renewal_amount // Update amount_paid
            // Add to the existing duration
        ];

        $enrollmentModel->update($enrollment_id, $data);

        // Insert a record into the renewals table
        $renewalData = [
            'enrollment_id' => $enrollment_id,
            'renew_date' => date('Y-m-d'),
            'months' => $renew_duration,
            'new_expiry_date' => $new_expiry_date,
            'renewal_amount' => $renewal_amount,
        ];

        $renewalModel->insert($renewalData);

        // Redirect with a success message
        return redirect()->to('/enrollment/renew/' . $student_id)
                         ->with('message', 'Course renewed successfully');
    }

    // If the enrollment is not found, redirect with an error message
    return redirect()->back()->with('error', 'Enrollment not found');
}
}