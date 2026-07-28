<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Employee_model;
use App\Models\Users_model;
use \Myth\Auth\Authorization\GroupModel;
use CodeIgniter\I18n\Time;


class Employee extends BaseController
{
    protected $employee;
    protected $groupModel;
    protected $userModel;
    public function __construct()
    {
        $this->employee     = new Employee_model();
        $this->groupModel   = new GroupModel();
        $this->userModel    = new Users_Model();
    }

    public function index()
    {
        $data  = [
            'title'     =>  'Karyawan',
            'employee'  =>  $this->employee->getEmployee(),
            'groups'    => $this->groupModel->findAll(),
        ];
        return view('admin/employee/index', $data);
    }

    public function pageAdd()
    {
        $data  = [
            'title'     =>  'Tambah Karyawan',
            'employee'  =>  $this->employee->getEmployee(),
            'users'     => $this->userModel->getUsers(),
            'now'       =>  Time::now(),
        ];
        return view('admin/employee/master', $data);
    }

    public function addEmployee()
    {
        if (!$this->validate([
            'first_name'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Nama Depan karyawan anda'
                ]
            ],
            'address'       => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Alamat karyawan anda'
                ]
            ],
            'phone'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Nomor karyawan anda yang dapat dihubungi.'
                ]
            ],
            'user_id'       => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap memilih Akun karyawan anda.'
                ]
            ],
            'nik'       => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi NIK karyawan.'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
            $data = array(
                'user_id'       => $this->request->getPost('user_id'),
                'nik'           => $this->request->getPost('nik'),
                'first_name'    => $this->request->getPost('first_name'),
                'last_name'     => $this->request->getPost('last_name'),
                'address'       => $this->request->getPost('address'),
                'phone'         => $this->request->getPost('phone'),
                'salary'        => $this->request->getPost('salary'),
                'created_at'    => Time::now(),
            );

            $save = $this->employee->insertEmployee($data);
            if ($save) {
                session()->setFlashdata('success', 'Karyawan Baru telah ditambahkan');
                return redirect()->to(base_url('employee'));
            }
        }
    }

    public function updateEmployee($id)
    {
        $data = array(
            'first_name'    => $this->request->getPost('first_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'address'       => $this->request->getPost('address'),
            'phone'         => $this->request->getPost('phone'),
            'salary'        => $this->request->getPost('salary'),
            'updated_at'    => Time::now(),
        );

        $save = $this->employee->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Data karyawan berhasil diubah');
            return redirect()->to(base_url('employee'));
        }
    }

    public function changeAccess()
    {
        $userId = $this->request->getVar('id');
        $groupId = $this->request->getVar('group');
        $groupModel = new GroupModel();

        $groupModel->removeUserFromAllGroups(intval($userId));
        $groupModel->addUserToGroup(intval($userId), intval($groupId));

        session()->setFlashdata('success', 'Akses karyawan telah diubah');
        return redirect()->to(base_url('employee'));
    }

    public function delete($id)
    {
        $this->employee->where('id', $id)->delete();
        session()->setFlashdata('success', 'Karyawan berhasil dihapus!');
        return redirect()->to(base_url('employee'));
    }
}
