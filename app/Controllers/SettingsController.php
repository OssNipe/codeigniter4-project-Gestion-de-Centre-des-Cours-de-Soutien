<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use CodeIgniter\Controller;
use App\Models\CourseModel; 
use App\Models\EnrollmentModel ; 


class SettingsController extends Controller
{
public function index()
    {
        $model = new SettingsModel();
        
        // Fetch the student's data based on the student ID
        $settings  = $model->first();


        // Pass the student data to the edit view
        return view('settings', ['settings' => $settings]);
    }
    public function update()
    {
        $settingsModel = new SettingsModel();
        $settings = $settingsModel->first(); // Fetch existing settings

        // Get form inputs
        $systemName = $this->request->getPost('system_name');
        $logo = $this->request->getFile('logo');

        $data = [
            'system_name' => $systemName
        ];

        // Handle logo upload if a new file is provided
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move('uploads/', $newName);
            $data['logo'] = 'uploads/' . $newName;
        }
        $settingsModel->update($settings['id'], $data);

        // Redirect with a success message
        return redirect()->to('/settings')->with('message', 'Settings updated successfully!');
    }
}
