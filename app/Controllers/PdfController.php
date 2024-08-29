<?php

namespace App\Controllers;

use App\Models\PdfModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class PdfController extends Controller
{
    public function index()
    {
        if (session()->get('role') == 'admin'):
        $pdfModel = new PdfModel();
        $data['pdfs'] = $pdfModel->findAll();
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();   
        return view('/pdf/pdf_list', $data);
        else:
            $user = (session()->get('id'));
            if (empty($user)) {
                return redirect()->to(base_url('/auth'));
            }
            $categoryModel = new CategoryModel();
            $data['categories'] = $categoryModel->findAll();   
            $pdfModel = new PdfModel();
            $data['pdfs'] = $pdfModel->where('created_by',$user)
                                    ->findAll();
            return view('/pdf/pdf_list',$data);
        endif;
    }

    public function edit($id) {
        $pdfModel = new PdfModel();
        $data['pdf'] = $pdfModel->find($id);
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();   
        return view('pdf/edit',$data);
    }

    public function detail($id) {
        $pdfModel = new PdfModel();
        $data['pdf'] = $pdfModel->find($id);
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();   
        return view('pdf/detail',$data);
    }

    public function update($id) {
        $pdfModel = new PdfModel();
        $file = $this->request->getFile('pdf');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/pdf/', $fileName);

            $data = [
                'file_name' => $file->getClientName(),
                'file_path' => 'uploads/pdf/' . $fileName,
                'created_by' => session()->get('id'),
                'description' => $this->request->getVar('desc'),
                'title' => $this->request->getVar('title'),
                'category' => $this->request->getVar('category'),
            ];
            $pdfModel->update($id,$data);
            
            return redirect()->to(base_url('/pdf'))->with('status', 'PDF uploaded successfully!');
        }
        return redirect()->to(base_url('/pdf'))->with('status', 'File upload failed.');
    }

    public function upload()
    {
        $pdfModel = new PdfModel();
        $file = $this->request->getFile('pdf');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/pdf/', $fileName);

            $data = [
                'file_name' => $file->getClientName(),
                'file_path' => 'uploads/pdf/' . $fileName,
                'created_by' => session()->get('id'),
                'description' => $this->request->getVar('desc'),
                'title' => $this->request->getVar('title'),
                'category' => $this->request->getVar('title'),
            ];
            $pdfModel->save($data);
            
            return redirect()->to(base_url('/pdf'))->with('status', 'PDF uploaded successfully!');
        }

        return redirect()->to(base_url('/pdf'))->with('status', 'File upload failed.');
    }

   public function searchPdfWithUser() {
       
    }


    public function search() {
        $search = $this->request->getVar('search');
        if (empty($search)) {
            return redirect()->to(base_url('/pdf'));
        }
    
        $pdfModel = new PdfModel();
        $data['pdfs'] = $pdfModel->like('description', $search)
                                 ->orLike('title', $search)
                                 ->findAll();
        return view('/pdf/pdf_list', $data);
        }   
}
