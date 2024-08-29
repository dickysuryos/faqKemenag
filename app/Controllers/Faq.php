<?php

namespace App\Controllers;
use App\Models\FaqModel;
use CodeIgniter\Controller;

class Faq extends BaseController
{
    public function index()
    {
    $session = session();
    if ($session->get('logged_in')) {
       $faqModel = new FaqModel();
        $data['faqs'] = $faqModel->findAll();
        return view('faq', $data);
    } else {
        return view('/auth/login');
        }
    }

    public function search() {
    $search = $this->request->getVar('search');
    if (empty($search)) {
        return redirect()->to(base_url('faq'));
    }

    $faqModel = new FaqModel();
    $data['faqs'] = $faqModel->like('question', $search)
                             ->orLike('answer', $search)
                             ->findAll();
    return view('faq', $data);
    }   
}