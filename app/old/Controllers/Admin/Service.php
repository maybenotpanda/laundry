<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Service_model;

class Service extends BaseController
{
    public function __construct()
    {
        $this->service = new Service_model();
    }
    
    public function index()
    {
        $data  = [
            'title' =>  'Layanan',
            'service' => $this->service->getService(),
        ];

        return view('admin/service/index', $data);
    }

    public function addService()
    {
        if (!$this->validate([
            'name'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Nama Layanan.'
                ]
            ],
            'price'       => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Harga Layanan.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
            'day'         => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Waktu Layanan.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
            $data = array(
                'name'   => $this->request->getPost('name'),
                'price'  => $this->request->getPost('price'),
                'day'    => $this->request->getPost('day'),
                'type'   => 'Kg'
            );
            $save = $this->service->insertService($data);
            if ($save) {
                session()->setFlashdata('success', 'Layanan Baru telah ditambahkan');
                return redirect()->to(base_url('service'));
            }
        }
    }

    
        public function updateService($id)
    {
        $data = array(
             'price'  => $this->request->getPost('price'),
            'day'    => $this->request->getPost('day')
        );

        $save = $this->service->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Data Layanan berhasil diubah');
            return redirect()->to(base_url('service'));
        }
    }


    public function delete($id)
    {
        $this->service->where('id', $id)->delete();
        session()->setFlashdata('success', 'Layanan berhasil dihapus!');
        return redirect()->to(base_url('service'));
    }
}
