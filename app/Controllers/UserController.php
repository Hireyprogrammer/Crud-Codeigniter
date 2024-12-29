<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('site/userForm', $data);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone')
        ];

        $this->userModel->insert($data);  
        
        session()->setFlashdata('user-success', 'User added successfully');
        return redirect()->to('/users');
    }

    

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone')
        ];

        $this->userModel->update($id, $data);
        
        session()->setFlashdata('user-success', 'User updated successfully');
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('user-success', 'User deleted successfully');
        return redirect()->to('/users');
    }
}
