<?php
namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\EnrollmentModel;
use App\Models\CourseModel;
use App\Models\RenewalModel;

class ReportController extends BaseController
{
    public function membershipReport()
    {
        return view('membership_report');
    }

    public function generateReport()
    {
        $fromDate = $this->request->getPost('from_date');
        $toDate = $this->request->getPost('to_date');

        $studentModel = new StudentModel();
        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        // Fetch students within the date range
        $students = $studentModel->select('students.id, students.fullname, students.email, students.contact_number')
            ->where('created_at >=', $fromDate)
            ->where('created_at <=', $toDate)
            ->findAll();

        // Fetch enrollments and courses for each student
        foreach ($students as &$student) {
            $enrollments = $enrollmentModel->where('student_id', $student['id'])->findAll();
            $student['courses'] = [];

            foreach ($enrollments as $enrollment) {
                $course = $courseModel->find($enrollment['course_id']);
                $expiryDate = $enrollment['expiry_date'];
                $status = '';

                // Calculate status based on the expiry date
                if ($expiryDate < date('Y-m-d')) {
                    $daysExpired = (strtotime(date('Y-m-d')) - strtotime($expiryDate)) / (60 * 60 * 24);
                    $status = "<span style='color: red;'>Expired ($daysExpired days ago)</span>";
                } else {
                    $status = 'Active';
                }

                $student['courses'][] = [
                    'course_name' => $course['course_name'],
                    'expiry_date' => $expiryDate,
                    'status' => $status
                ];
            }
        }

        return view('membership_report', [
            'students' => $students,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ]);
    }
    public function revenuReport()
    {
        return view('revenue_report');
    }
    public function generateRevenueReport()
    {
        $fromDate = $this->request->getPost('from_date');
        $toDate = $this->request->getPost('to_date');

        $studentModel = new StudentModel();
        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        // Fetch students within the date range
        $students = $studentModel->select('students.id, students.fullname, students.email, students.contact_number,students.created_at')
            ->where('created_at >=', $fromDate)
            ->where('created_at <=', $toDate)
            ->findAll();

        // Fetch enrollments and courses for each student
        foreach ($students as &$student) {
            $enrollments = $enrollmentModel->where('student_id', $student['id'])->findAll();
            $student['courses'] = [];

            foreach ($enrollments as $enrollment) {
                $course = $courseModel->find($enrollment['course_id']);
                $amount = $enrollment['amount_paid'];
                $status = '';

                // Calculate status based on the expiry date
                

                $student['courses'][] = [
                    'course_name' => $course['course_name'],
                    'amount_paid' => $amount,
                    'status' => $status
                ];
            }
        }

        return view('revenue_report', [
            'students' => $students,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ]);
    }
}
