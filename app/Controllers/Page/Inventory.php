<?php

namespace App\Controllers\Page;

use App\Controllers\BaseController;
use App\Models\Inventory_model;
use CodeIgniter\I18n\Time;

class Inventory extends BaseController
{
    protected $inventory;

    public function __construct()
    {
        $this->inventory = new Inventory_model();
    }
    public function index()
    {
        $data  = [
            'title' =>  'Pengajuan Pembelian',
            'inventory' => $this->inventory->getInventory()
        ];
        return view('page/inventory/index', $data);
    }

    public function newitem()
    {
        $data  = [
            'title' =>  'Pengajuan Pembelian',
            'now' =>  Time::now(),
        ];
        return view('page/inventory/master', $data);
    }

    public function addInventory()
    {
        if (!$this->validate([
            'name'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Nama Pengajuan.'
                ]
            ],
            'price'    => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Harga.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
            'qty'    => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Jumlah.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
            'unit'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap memilih Satuan.'
                ]
            ],
            'note'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap mengisi Keterangan.'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $qty = (float)$this->request->getVar('qty');
            $price = (float)$this->request->getVar('price');
            $total = $price * $qty;
            $invoice = $this->inventory->getInvoice();
            $newinvoice = 'INV/10' . $invoice;
            $data = array(
                'invoice' => $newinvoice,
                'user_id'     => $this->request->getPost('user_id'),
                'name'    => $this->request->getPost('name'),
                'price'    => $this->request->getPost('price'),
                'qty'    => $this->request->getPost('qty'),
                'unit'    => $this->request->getPost('unit'),
                'status'    => 'Pengajuan',
                'note'    => $this->request->getPost('note'),
                'total'    => $total,
                'created_at' => Time::now(),
            );
            $simpan = $this->inventory->insertInventory($data);
            if ($simpan) {
                session()->setFlashdata('success', 'Data Pengajuan berhasil ditambah');
                return redirect()->to(base_url('barang'));
            }
        }
    }

    public function updateInventory($id)
    {
        $qty = (float)$this->request->getVar('qty');
        $price = (float)$this->request->getVar('price');
        $total = $price * $qty;
        $data = array(
            'name'    => $this->request->getPost('name'),
            'price'         => $this->request->getPost('price'),
            'qty'     => $this->request->getPost('qty'),
            'note'        => $this->request->getPost('note'),
            'total'    => $total,
            'updated_at'    => Time::now(),
        );

        $save = $this->inventory->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Data Pengajuan berhasil diubah');
            return redirect()->to(base_url('barang'));
        }
    }

    public function updateStatus($id)
    {
        $data = array(
            'status'    => $this->request->getPost('status'),
            'updated_at'    => Time::now(),
        );

        $save = $this->inventory->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Data Pengajuan berhasil diubah');
            return redirect()->to(base_url('transaksi-pembelian'));
        }
    }

    public function deleteInventory($id)
    {
        $this->inventory->where('id', $id)->delete();
        session()->setFlashdata('success', 'Pengajuan berhasil dihapus!');
        return redirect()->to(base_url('transaksi-pembelian'));
    }
}
