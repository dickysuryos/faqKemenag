<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $user = $model->getUserByUsername($username);
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => TRUE
                ];
                $session->set($sessionData);

                if ($user['role'] === 'admin') {
                    return redirect()->to('/');
                } else {
                    return redirect()->to('/');
                }
            } else {
                $session->setFlashdata('msg', 'Invalid password.');
                return redirect()->to('/auth');
            }
        } else {
            $session->setFlashdata('msg', 'User not found.');
            return redirect()->to('/auth');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }

    public function register()
{
    return view('auth/register');
}
public function store()
{
    $validation = $this->validate([
        'username' => 'required|min_length[3]|is_unique[users.username]',
        'password' => 'required|min_length[5]',
        'role' => 'required|in_list[admin,user]'
    ]);

    if (!$validation) {
        return view('auth/register', ['validation' => $this->validator]);
    }

    $model = new \App\Models\UserModel();

    $data = [
        'username' => $this->request->getVar('username'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'role' => $this->request->getVar('role')
    ];

    $model->save($data);

    session()->setFlashdata('msg', 'Registration successful! You can now log in.');
    return redirect()->to('/auth');
}

}
