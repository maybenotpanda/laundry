<?php

namespace App\Controllers\Page;

use App\Models\Employee_model;
use App\Models\Users_model;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Password;
use \Myth\Auth\Models\UserModel;
use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->user         = new UserModel();
        $this->employee     = new Employee_model();
        $this->groupModel   = new GroupModel();
        $this->userModel    = new Users_Model();
    }
    public function index($id)
    {
        $row = $this->employee->getDetail($id);
        if ($row) {
            $data  = [
                'e' => $row,
                'title' =>  'Profile',
            ];
            return view('page/profile/index', $data);
        } else {
            redirect(base_url('home'));
        }
    }
    public function updatePassword($id){
        if (!$this->validate([
            'password'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Kata Sandi Baru.'
                ]
            ],
            'pass_confirm'    => [
                'rules'     => 'required|matches[password]',
                'errors'    => [
                    'required' => 'Harap mengisi Konfirmasi Kata Sandi Baru.',
                    'matches' => 'Harap mengisi kata sandi anda yang sama.'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('dashboard'));
        } else {
            print_r($this->request->getVar());
            $data = array(
                'id' => $id,
                'password_hash'     => Password::hash($this->request->getPost('password')),
                
            );
            $save = $this->user->update($id, $data);
            if ($save) {
                session()->setFlashdata('success', 'Password berhasil diubah');
                return redirect()->to(base_url('dashboard'));
            }
        }
    }
}
