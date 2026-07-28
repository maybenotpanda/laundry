<?php

namespace App\Controllers\Page;

use App\Controllers\BaseController;
use App\Models\Customer_model;
use CodeIgniter\I18n\Time;

class Customer extends BaseController
{

    protected $customer = 'App\Models\Customer_model';
    public function __construct()
    {
        $this->customer = new Customer_model();
    }
    public function index()
    {

        $data  = [
            'title' =>  'Pelanggan',
            'customer' => $this->customer->getCustomer(),
        ];
        return view('page/customer/index', $data);
    }

    public function addCustomer()
    {
        if (!$this->validate([
            'name'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Nama pelanggan.'
                ]
            ],
            'address'       => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Alamat pelanggan.',
                ]
            ],
            'phone'         => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Nomor Telepon pelanggan.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
            $data = array(
                'name'     => $this->request->getPost('name'),
                'address'  => $this->request->getPost('address'),
                'phone'    => $this->request->getPost('phone'),
                'created_at'        => Time::now()
            );
            $save = $this->customer->insertCustomer($data);
            if ($save) {
                session()->setFlashdata('success', 'Pelanggan Baru telah ditambahkan');
                return redirect()->to(base_url('customer'));
            }
        }
    }

    public function update($id)
    {
        $data = array(
            'name'   => $this->request->getPost('name'),
            'address'  => $this->request->getPost('address'),
            'phone'    => $this->request->getPost('phone'),
            'updated_at'        => Time::now()
        );

        $save = $this->customer->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Data Pelanggan berhasil diubah');
            return redirect()->to(base_url('customer'));
        }
    }

    public function delete($id)
    {
        $this->customer->where('id', $id)->delete();
        session()->setFlashdata('success', 'Pelanggan berhasil dihapus!');
        return redirect()->to(base_url('customer'));
    }
}
