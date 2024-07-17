<?php

namespace App\Controllers\Page;

use App\Models\Laundry_model;
use App\Models\Inventory_model;
use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    protected $laundry;
    protected $inventory;

    public function __construct()
    {
        $this->laundry = new Laundry_model();
        $this->inventory = new Inventory_model();
    }
    public function index()
    {
        $totalprocess = $this->laundry
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->where('activity_id', 1)
            ->countAllResults();
        $totallaundry = $this->laundry
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->countAllResults();
        $pendapatanHariIni = $this->laundry->selectSum('total')
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->first();
        $pengeluaran = $this->inventory->selectSum('total')
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->where('status', 'Diterima')
            ->first();
        $total = $pengeluaran;
        $total_customer = $this->laundry->countAllResults();
        $data  = [
            'title' =>  'Dashboard',
            'pendapatanHariIni' => $pendapatanHariIni,
            'outcome' => $pengeluaran,
            'total' => $total,
            'laundry' => $this->laundry->trakhir(),
            'customer' => $total_customer,
            'totallaundry' => $totallaundry,
            'totalprocess' => $totalprocess

        ];
        return view('page/index', $data);
    }
    public function donothaveaccess()
    {
        $data  = [
            'title' =>  'Do Not Have Access',
        ];
        return view('donothaveaccess', $data);
    }
}
