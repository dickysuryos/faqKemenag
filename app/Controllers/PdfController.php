<?php

namespace App\Controllers;

use App\Models\PdfModel;
use CodeIgniter\Controller;

class PdfController extends Controller
{
    public function index()
    {
        if (session()->get('role') == 'admin'):
        $pdfModel = new PdfModel();
        $data['pdfs'] = $pdfModel->findAll();
        return view('pdf_list', $data);
        else:
            $user = (session()->get('id'));
            if (empty($user)) {
                return redirect()->to(base_url('/auth'));
            }
            $pdfModel = new PdfModel();
            $data['pdfs'] = $pdfModel->where('created_by',$user)
                                    ->findAll();
            return view('pdf_list',$data);
        endif;
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
            
            return redirect()->to('/pdf')->with('status', 'PDF uploaded successfully!');
        }

        return redirect()->to('/pdf')->with('status', 'File upload failed.');
    }

   public function searchPdfWithUser() {
       
    }
}
