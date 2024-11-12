<?php

namespace App\Controllers;

use App\Models\CourseModel;
use CodeIgniter\Controller;

class CourseController extends Controller
{
    // Show the form to add a student
    public function create()
    {
        return view('add_course');
    }

    public function manageCourses()
    {
        $model = new CourseModel();
        
        // Fetch all students from the database
        $data['courses'] = $model->findAll();  // Fetches all students
        
        // Pass the students data to the view
        return view('manage_courses', $data);
    }
    public function edit($id)
    {
        $model = new CourseModel();
        
        // Fetch the student's data based on the student ID
        $course = $model->find($id);

        // Check if student exists
        if (!$course) {
            return redirect()->to('courses/manage')->with('error', 'Course not found');
        }

        // Pass the student data to the edit view
        return view('edit_course', ['course' => $course]);
    }

    // Handle the form submission and update student data in the database
    public function update($id)
    {
        $model = new CourseModel();

        // Get the input data from the form
        $data = [
            'course_name'      => $this->request->getPost('course_name'),
            'price'           => $this->request->getPost('price'),
            
        ];

        // Handle the file upload for photo (optional)
      

        // Update the student record
        $model->update($id, $data);

        // Redirect to the students page with a success message
        return redirect()->to('/courses/manage')->with('message', 'Course updated successfully');}
    // Handle the form submission and add a student to the database
    public function store()
    {
        $model = new CourseModel();

        // Get the input data from the formF
        $data = [
            'course_name'      => $this->request->getPost('course_name'),
            'price'           => $this->request->getPost('price'),
            
        ];
       

        // Insert data into the students table
        if ($model->save($data)) {
            // Set a flashdata message on successful insertion
            session()->setFlashdata('message', 'Course added successfully');
        } else {
            // Handle the case when saving fails (optional)
            session()->setFlashdata('message', 'There was an error adding the course');
        }
        // Redirect or return a success message
        return redirect()->to('course/create')->with('message', 'Course added successfully');
    }
    public function delete($id)
    {
        $model = new CourseModel();

        // Check if the student exists before trying to delete
        $course = $model->find($id);

        if (!$course) {
            return redirect()->to('/courses/manage')->with('error', 'Course not found');
        }

        // Delete the student's photo if it exists
        

        // Delete the student record from the database
        $model->delete($id);

        // Redirect back to the students list with a success message
        return redirect()->to('/courses/manage')->with('message', 'Course deleted successfully');
    }

}
