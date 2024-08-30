<?php

namespace App\Controllers;
use App\Models\FaqModel;
use CodeIgniter\Controller;
use App\Models\CategoryModel;
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
    $category = $this->request->getVar('category');

    if (empty($search)) {
        return redirect()->to(base_url('faq'));
    }
    $catModel = new CategoryModel();

    $faqModel = new FaqModel();
    $data['faqs'] = $faqModel
                             ->where('category',$catModel->where('id',$category)->first()['name'])
                             ->findAll();
                             
    $data['category'] = $catModel->where('id',$category)->first();
    return view('faq', $data);
    }   
}