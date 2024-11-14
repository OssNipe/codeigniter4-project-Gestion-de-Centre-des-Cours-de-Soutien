<?php
namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $studentModel = new StudentModel();
        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        // 1. Total number of students
        $totalStudents = $studentModel->countAll();

        // 2. Total number of courses
        $totalCourses = $courseModel->countAll();

        // 3. Number of memberships expiring soon (within the next 7 days)
        $expiringMemberships = $enrollmentModel
            ->where('expiry_date <=', date('Y-m-d', strtotime('+7 days')))
            ->where('expiry_date >=', date('Y-m-d'))
            ->countAllResults();

        // 4. Total revenue from all enrollments
        $totalRevenue = $enrollmentModel->selectSum('amount_paid')->first()['amount_paid'];

        // 5. New members (students enrolled in the last 30 days)
        $newMembers = $studentModel
            ->where('created_at >=', date('Y-m-d', strtotime('-30 days')))
            ->countAllResults();

        // 6. Expired memberships
        $expiredMemberships = $enrollmentModel
            ->where('expiry_date <', date('Y-m-d'))
            ->countAllResults();

        // Pass data to the view
        $data = [
            'totalStudents' => $totalStudents,
            'totalCourses' => $totalCourses,
            'expiringMemberships' => $expiringMemberships,
            'totalRevenue' => $totalRevenue,
            'newMembers' => $newMembers,
            'expiredMemberships' => $expiredMemberships
        ];

        return view('dashboard', $data);
    }
}
