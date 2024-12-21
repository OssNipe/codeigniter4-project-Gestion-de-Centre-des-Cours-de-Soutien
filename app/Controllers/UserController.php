<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UserController extends Controller
{
    public function addUserToGroups()
    {
        // Load the authentication library
        $auth = auth();

        // Get the authenticated user
        $user = $auth->user();

        // Check if the user is logged in
        if (!$user) {
            return redirect()->to('/login')->with('error', 'You need to log in first.');
        }

        // Add the user to the 'admin' and 'beta' groups
        try {
            $user->addGroup('admin', 'beta');

            // Load success message
            $data = [
                'user' => $user,
                'groups' => ['admin', 'beta'],
                'message' => 'User successfully added to the groups.'
            ];

            return view('add_user_to_groups', $data);

        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
