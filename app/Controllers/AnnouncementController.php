<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use CodeIgniter\Controller;

class AnnouncementController extends Controller
{
    // Show the form to add a student
    public function create()
    {
        return view('add_announcement' );
    }
    public function manageAnnouncements()
    {
        $model = new AnnouncementModel();
        
        // Fetch all students from the database
        $data['announcements'] = $model->findAll();  // Fetches all students
        
        // Pass the students data to the view
        return view('manage_announcements', $data);
    }
    public function update($id)
    {
        $model = new AnnouncementModel();

        // Get the input data from the form
        $data = [
            'title'      => $this->request->getPost('title'),
            'description'=> $this->request->getPost('description'),
        ];

        // Handle the file upload for photo (optional)
        $file = $this->request->getFile('image');
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the uploaded photo to the public/images/ folder
            $uploadPath = FCPATH . 'images';
            $file->move($uploadPath, $file->getName());
            $data['image'] = $file->getName();
        }

        // Update the student record
        $model->update($id, $data);

        // Redirect to the students page with a success message
        return redirect()->to('/announcements/manage')->with('message', 'Announcement updated successfully');}
    public function edit($id)
    {
        $model = new AnnouncementModel();
        
        // Fetch the student's data based on the student ID
        $announcement = $model->find($id);

        // Check if student exists
        if (!$announcement) {
            return redirect()->to('announcements/manage')->with('error', 'Student not found');
        }

        // Pass the student data to the edit view
        return view('edit_announcement', ['announcement' => $announcement]);
    }

public function delete($id)
{
    $model = new AnnouncementModel();

    // Check if the student exists before trying to delete
    $announcement = $model->find($id);

    if (!$announcement) {
        return redirect()->to('/announcements/manage')->with('error', 'Student not found');
    }

    // Delete the student's photo if it exists
    if (!empty($announcement['image'])) {
        $photoPath = FCPATH . 'images/' . $announcement['image'];
        if (file_exists($photoPath)) {
            unlink($photoPath); // Delete the file from the server
        }
    }

    // Delete the student record from the database
    $model->delete($id);

    // Redirect back to the students list with a success message
    return redirect()->to('/announcements/manage')->with('message', 'Student deleted successfully');
}
    public function store()
    {
        $model = new AnnouncementModel();

        // Get the input data from the formF
        $data = [
            'title'      => $this->request->getPost('title'),
            'description'           => $this->request->getPost('description'),
           
            'image'         => $this->request->getPost('image')  // Optionally handle file uploads
        ];
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            // Define the path to store the file in the 'public/uploads/images' directory
            $uploadPath = FCPATH . 'images';
            $image->move($uploadPath, $image->getName());  // If you're still using the writable folder for temporary storage
            $data['image'] = $image->getName();  // Store the file name in the database
        }
       if($model->insert($data)){
       
            session()->setFlashdata('message', 'Student added successfully');

        } else {
            // Handle the case when saving fails (optional)
            session()->setFlashdata('message', 'There was an error adding the student');
        }
        // Insert data into the students table
        
        // Redirect or return a success message
        return redirect()->to('announcement/create')->with('message', 'Student added successfully');
    }
}