<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function logout()
    {
        // Check if the auth() service is properly loaded
        $auth = auth();
        if ($auth) {
            $auth->logout(); // Log the user out
        }

        // Clear any existing session data and redirect to the login page
        session()->destroy();
        return redirect()->to('/login')->with('message', 'You have been logged out.');
    }
}
