<?php

namespace App\Controllers;

use App\Models\CategoryModel;
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
                    'category' => $user['category_section'],
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
    $category = new CategoryModel();
    $user = new UserModel();
    $session = session();
    $activeUser = $user->getUserByID($session->get('id'));
    $data['user'] = $user->like('category_section',$activeUser['category_section'])
                         ->findAll();
    //  $data['user'] = $activeUser;
    $data['categories'] = $category->findAll();   
    return view('auth/register',$data);

}
public function store()
{
    $category = new CategoryModel();
    $data['categories'] = $category->findAll(); 
    $validation = $this->validate([
        'username' => 'required|min_length[3]|is_unique[users.username]',
        'password' => 'required|min_length[5]',
        'category' => 'required',
        'role' => 'required|in_list[admin,user]'
    ]);

    if (!$validation) {
         
        return view('auth/register', ['validation' => $this->validator,'categories' => $category->findAll()]);
    }
    $model = new UserModel();
    $datas = [
        'username' => $this->request->getVar('username'),
        'category_section' => $this->request->getVar('category'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'role' => $this->request->getVar('role')
    ];
    ;
    

    $model->save($datas);
    $session = session();
    
    $activeUser = $model->getUserByID($session->get('id'));
    $data['user'] = $model->like('category_section','haji dan umrah')
                     ->findAll();
    // session()->setFlashdata('msg', 'Registration successful! You can now log in.');
       return view('/auth/register',$data);
    //    return redirect()->to('/auth/register',$data);
    }

    public function delete($id) {
        $session = session();
        if ($session->get('logged_in')) {
            if ($session->get('role') === 'admin') { 
            $userModel = new UserModel();
            $userModel->delete($id);
            return redirect()->to('/auth/register');
            }
        }
    }

}
