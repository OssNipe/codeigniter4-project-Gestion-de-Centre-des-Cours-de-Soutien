<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Shield\Models\UserModel;

class FormController extends Controller
{
    public function index()
    {
        // Get the authenticated user data
        $user = auth()->user();

        // If the user is not logged in, you can redirect to the login page
     

        // Pass the user data to the view
        return view('form_view', ['user' => $user]);
    }
}
