<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;

class StudentController extends Controller
{
    // Show the form to add a student
    public function create()
    {
        return view('add_student');
    }
    public function manageMembers()
    {
        $model = new StudentModel();
        
        // Fetch all students from the database
        $data['students'] = $model->findAll();  // Fetches all students
        
        // Pass the students data to the view
        return view('manage_members', $data);
    }

    // Handle the form submission and add a student to the database
    public function store()
    {
        $model = new StudentModel();

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

        // Insert data into the students table
        if ($model->save($data)) {
            // Set a flashdata message on successful insertion
            session()->setFlashdata('message', 'Student added successfully');
        } else {
            // Handle the case when saving fails (optional)
            session()->setFlashdata('message', 'There was an error adding the student');
        }
        // Redirect or return a success message
        return redirect()->to('student/create')->with('message', 'Student added successfully');
    }
}
