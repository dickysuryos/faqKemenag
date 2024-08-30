<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{

    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll(); // Fetch all categories from the database
        return view('/category/category_view', $data); // Load the view and pass the categories data
    }

    public function update($id)
    {
        $categoryModel = new CategoryModel();
        $validation = \Config\Services::validation();
        $file = $this->request->getFile('images');
        // $validation->setRules([
        //     'name' => 'required',
        //     'images' => 'zmax_size[image,2048]|is_image[image][image,image/jpg,image/jpeg,image/gif,image/png]',
        // ]);
       
       
        // if (!$validation->withRequest($this->request)->run()) {
        //     // $data['category'] = $categoryModel->find($id);
        //     return redirect()->to(base_url('/category/categories'));
        // }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/icon/', $newName);

            $data = [
                'name' => $this->request->getVar('name'),
                'image' => $newName,
            ];
            $categoryModel->update($id, $data);

            return redirect()->to(base_url('/category/categories'));
        }
        return view('categories/edit', ['error' => 'Image upload failed']);
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
       
        $data['category'] = $categoryModel->find($id);
        
        return view('/category/edit', $data);
    }

    public function create()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $categoryModel = new CategoryModel();
            $validation = \Config\Services::validation();
            // $validation->setRules([
            //     'name' => 'required',
            //     'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
            // ]);

            // if (!$validation->withRequest($this->request)->run()) {
            //     return view('/category/create', ['validation' => $validation]);
            // }

            $file = $this->request->getFile('image');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/icon/', $newName);

                $data = [
                    'name' => $this->request->getVar('name'),
                    'image' => $newName,
                ];

                $categoryModel->insert($data);


                return redirect()->to(base_url('/category/categories'));
            }
            return view('categories/create', ['error' => 'Image upload failed']);
        } else {
            return view('/auth/login');
        }
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);

        return redirect()->to(base_url('/category/categories'));
    }
}
