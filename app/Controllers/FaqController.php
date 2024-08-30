<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\UserActivityModel;
use CodeIgniter\Controller;
use App\Models\CategoryModel;
class FaqController extends Controller
{
    public function index()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $faqModel = new FaqModel();
            $data['faqs'] = $faqModel->findAll();

            return view('faq/index', $data);
        } else {
            return view('/auth/login');
        }
    }

    public function create()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $categoryModel = new CategoryModel();
            $data['categories'] = $categoryModel->findAll();
            return view('faq/create', $data);
        } else {
            return view('/auth/login');
        }
    }

    public function store()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $faqModel = new FaqModel();

            $data = [
                'question' => $this->request->getVar('question'),
                'answer' => $this->request->getVar('answer'),
            ];

            $faqModel->insert($data);

            return redirect()->to(base_url('faqs'));
        } else {
            return view('/auth/login');
        }
    }

    public function edit($id)
    {
        $session = session();
        if ($session->get('logged_in')) {
        $faqModel = new FaqModel();
        $data['faq'] = $faqModel->find($id);
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('faq/edit', $data);
        }
        return view('/auth/login');
    }

    public function update($id)
    {
        $session = session();
        if ($session->get('logged_in')) {
        $faqModel = new FaqModel();
        $activity = new UserActivityModel();
        $data = [
            'question' => $this->request->getVar('question'),
            'answer' => $this->request->getVar('answer'),
            'category' => $this->request->getVar('category'),
        ];

       $faqModel->update($id, $data);
       
        $result = $activity->create_activitys('update data "'.$data['question'].'"');
        return redirect()->to(base_url('faqs'));
     }
     return view('/auth/login');
    }

    public function delete($id)
    {
        $session = session();
        if ($session->get('logged_in')) {
        $faqModel = new FaqModel();
        $faqModel->delete($id);

        return redirect()->to(base_url('faqs'));
        }
        return view('/auth/login');
    }

    public function getFaqByCat()
    {
        $session = session();
        if ($session->get('logged_in')) {
        $category = $this->request->getVar('category');
        if (empty($category)) {
            return redirect()->to(base_url('faqs'));
        }
        $catModel = new CategoryModel();
        $faqModel = new FaqModel();
        
        $data['faqs'] = $faqModel->orWhere('category', $catModel->where('id',$category)->first()['name'])
            ->orLike('category', $category)
            ->orHaving('category', $category)
            ->orHavingLike('category', $category)
            ->orHavingIn('category', explode(" ", $category))
            ->findAll();
        $data['category'] = $catModel->where('id',$category)->first();

        return view('faq', $data);
        }
        return view('/auth/login');
    }
    public function search()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $search = $this->request->getVar('search');
            if (empty($search)) {
                return redirect()->to(base_url('/faqs'));
            }
            $catModel = new CategoryModel();
            $faqModel = new FaqModel();
            $data['faqs'] = $faqModel->like('question', $search)
                ->orLike('answer', $search)
                ->findAll();

            
            return view('/faq/index', $data);
        }
        else {
            return view('/auth/login');
        }
    }
}