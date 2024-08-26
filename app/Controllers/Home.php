<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $session = session();

        // Check if the user is logged in
        if ($session->get('logged_in')) {
            $data = [
                'username' => $session->get('username'),
                'role' => $session->get('role')
            ];
        } else {
            $data = [
                'username' => null,
                'role' => null
            ];
            return view('auth/login', $data);
        }

        return view('welcome_message', $data);
    }
}
