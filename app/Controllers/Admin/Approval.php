<?php

namespace App\Controllers\Admin;

use App\Models\Inventory_model;
use App\Controllers\BaseController;

class Approval extends BaseController
{
    protected $inventory;

    public function __construct()
    {
        $this->inventory = new Inventory_model();
    }
    public function index()
    {
        $data  = [
            'title' =>  'Approval Barang',
            'inventory' => $this->inventory->getInventory()
        ];
        return view('admin/inventory/index', $data);
    }

    public function deleteInventory($id)
    {
        $this->inventory->where('id', $id)->delete();
        session()->setFlashdata('success', 'Pengajuan Pembelian berhasil dihapus!');
        return redirect()->to(base_url('persetujuan-pembelian'));
    }
}
