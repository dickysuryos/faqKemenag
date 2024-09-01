<?php

namespace App\Controllers;

use App\Models\MessagingModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class MessagingController extends Controller
{

    public function store() {
        $session = session();
        // if (!empty($this->request->getVar('message'))) {
			$messaging = new MessagingModel();
			$data = [
				'message' => $this->request->getVar('text'),
				'created_by' => session()->get('id'),
                'sending_to' => $this->request->getVar('userid'),
			];
			$messaging->save($data);
            // $categoryModel = new CategoryModel();
            // $data = [
            //     'username' => $session->get('username'),
            //     'role' => $session->get('role'),
            //     'category' => $categoryModel->findAll()
            // ];
        // }
        // return view('welcome_message',$data);
       return redirect()->back();
    }

   
}