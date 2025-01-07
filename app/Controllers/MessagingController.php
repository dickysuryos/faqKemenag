<?php

namespace App\Controllers;

use App\Models\MessagingModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class MessagingController extends Controller
{

    public function index() {
        $session = session();
        // Check if the user is logged in
        $message = new MessagingModel();
        $message = $message->findAll();
        if ($session->get('logged_in')) {
                 foreach ($message as $chat):
				if ($chat['sending_to'] == session()->get('id')):
					$data = ['isRead' => 1];
					$model = new MessagingModel();
					$model->update($chat['id'], $data);
				endif;
			endforeach;
            $categoryModel = new CategoryModel();
            $message = new MessagingModel();
            $data = [
                'message' => $message->getBy()
            ];
        } else {
            $data = [
                'username' => null,
                'role' => null
            ];
            return view('auth/login', $data);
            }

        return view('/messaging/index', $data);
        }
    public function store() {
        $session = session();
        // if (!empty($this->request->getVar('message'))) {
			$messaging = new MessagingModel();
			$data = [
				'message' => $this->request->getVar('text'),
				'created_by' => session()->get('id'),
                'sending_to' => $this->request->getVar('userid'),
                'isRead' => 0,
			];
			$messaging->save($data);
       return redirect()->back();
    }

   
}