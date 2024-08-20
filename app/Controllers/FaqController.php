<?php

namespace App\Controllers;

use App\Models\FaqModel;
use CodeIgniter\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqModel = new FaqModel();
        $data['faqs'] = $faqModel->findAll();

        return view('faq/index', $data);
    }

    public function create()
    {
        return view('faq/create');
    }

    public function store()
    {
        $faqModel = new FaqModel();

        $data = [
            'question' => $this->request->getVar('question'),
            'answer'   => $this->request->getVar('answer'),
        ];

        $faqModel->insert($data);

        return redirect()->to(base_url('faqs'));
    }

    public function edit($id)
    {
        $faqModel = new FaqModel();
        $data['faq'] = $faqModel->find($id);

        return view('faq/edit', $data);
    }

    public function update($id)
    {
        $faqModel = new FaqModel();

        $data = [
            'question' => $this->request->getVar('question'),
            'answer'   => $this->request->getVar('answer'),
        ];

        $faqModel->update($id, $data);

        return redirect()->to(base_url('faqs'));
    }

    public function delete($id)
    {
        $faqModel = new FaqModel();
        $faqModel->delete($id);

        return redirect()->to(base_url('faqs'));
    }
}