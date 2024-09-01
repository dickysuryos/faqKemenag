<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use App\Models\MessagingModel;
use App\Models\UserModel;
class Home extends BaseController
{
    public function index(): string
    {
        $session = session();

        // Check if the user is logged in
        if ($session->get('logged_in')) {
            $categoryModel = new CategoryModel();
            $message = new MessagingModel();
            $user = new UserModel();
            $data = [
                'username' => $session->get('username'),
                'role' => $session->get('role'),
                'category' => $categoryModel->findAll(),
                // 'user' => $user->first(),
                'message' => $message->getBy()
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
