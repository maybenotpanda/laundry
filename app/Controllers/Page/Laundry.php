<?php

namespace App\Controllers\Page;

use App\Controllers\BaseController;
use App\Models\Customer_model;
use App\Models\Laundry_model;
use App\Models\Activity_model;
use CodeIgniter\I18n\Time;
use App\Models\Service_model;

class Laundry extends BaseController
{
    protected $laundry;
    protected $customer;
    protected $service;
    protected $activity;
    public function __construct()
    {
        $this->laundry = new Laundry_model();
        $this->customer = new Customer_model();
        $this->service = new Service_model();
        $this->activity = new Activity_model();
    }
    public function index()
    {
        // $total_customer = $this->laundry->countAllResults();
        $totalprocess = $this->laundry
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->where('activity_id', 1)
            ->countAllResults();
        $uptodate = $this->laundry
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->countAllResults();
        $finished = $this->laundry
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->where('activity_id >', 1)
            ->countAllResults();
        $latest = $this->laundry
            ->where('created_at <', date('Y-m-', strtotime(Time::now())) . '1')
            ->countAllResults();
        $outcome = $this->laundry->selectSum('paid')
            ->where('created_at >', date('Y-m-', strtotime(Time::now())) . '1')
            ->where('created_at <', date('Y-m-t', strtotime(Time::now())))
            ->first();
        $data  = [
            'title' =>  'Laundry',
            'laundry' => $this->laundry->getLaundry(),
            'activity' => $this->activity->getActivity(),
            'totalprocess' => $totalprocess,
            'finished' => $finished,
            'uptodate' => $uptodate,
            'outcome' => $outcome,
            'latest' => $latest

        ];
        return view('page/laundry/index', $data);
    }

    public function pageAdd()
    {
        $data  = [
            'title' =>  'Tambah Laundry',
            'customer' => $this->customer->getCustomer(),
            'service' => $this->service->getService(),
            'now' =>  Time::now(),
        ];
        return view('page/laundry/master', $data);
    }

    public function addLaundry()
    {
        if (!$this->validate([
            'id_customer'    => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap memilih Pelanggan anda.'
                ]
            ],
            'id_service'       => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Harap memilih Layanan Pelanggan anda.'
                ]
            ],
            'weight'         => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Berat Pakaian Pelanggan anda.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
            'qty'       => [
                'rules'     => 'required|numeric',
                'errors'    => [
                    'required' => 'Harap mengisi Jumlah Pakaian Pelanggan anda.',
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            // Invoice
            $invoice = $this->laundry->getInvoice();
            $newinvoice = 'TRX-09' . $invoice;

            // Date
            $now = date(strtotime($this->request->getVar('created_at')));
            $estimation = $this->request->getVar('day_service');
            $results = 86400 * $estimation;
            $totalDate = $now + $results;
            $newDate = Date("Y-m-d h:i:s", $totalDate);

            // Total Price
            $weight = (float)$this->request->getVar('weight');
            $price = (float)$this->request->getVar('price_service');
            $totalPayment = $price * $weight;
            $data = array(
                'customer_id'     => $this->request->getPost('id_customer'),
                'activity_id'  => 1,
                'service_id'    => $this->request->getPost('id_service'),
                'user_id'     => $this->request->getPost('user_id'),
                'invoice' => $newinvoice,
                'weight'    => $this->request->getPost('weight'),
                'price' => $totalPayment,
                'qty'    => $this->request->getPost('qty'),
                'paid' => 0,
                'note'    => $this->request->getPost('note'),
                'status' => 'Belum Lunas',
                'created_at' => Time::now(),
                'finished_at' => $newDate,
            );

            $save = $this->laundry->insertLaundry($data);
            if ($save) {
                session()->setFlashdata('success', 'Transaksi baru berhasil ditambahkan');
                return redirect()->to(base_url('payment/' . $newinvoice));
            }
        }
    }

    public function paid($id)
    {
        if (!$this->validate([
            'paid'       => [
                'rules'     => 'numeric',
                'errors'    => [
                    'numeric' => 'Harap mengisi angka!'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $price = (float)$this->request->getVar('price');
            $paid = (float)$this->request->getVar('paid');
            if ($paid < $price) {
                $kembalian = $price - $paid;
                $total = $paid;
                $status = 'Belum Lunas';
            } else if ($paid == $price) {
                $kembalian = 0;
                $total = $price;
                $status = 'Lunas';
            } else if ($price < $paid) {
                $kembalian = $paid - $price;
                $total = $price;
                $status =  'Lunas';
            }

            $data = array(
                'paid'   => $paid,
                'status'   => $status,
                'result' => $kembalian,
                'total' => $total,
                'updated_at' => Time::now(),
            );

            $save = $this->laundry->update($id, $data);
            if ($save) {
                session()->setFlashdata('success', 'Transaksi berhasil');
                return redirect()->to(base_url('laundry/invoice/' . $id));
            }
        }
    }

    public function payment($inovice)
    {
        $row = $this->laundry->getDetail($inovice);
        if ($row) {
            $data  = [
                'laundry' => $row,
                'title' =>  'Laundry',
                'now' =>  Time::now(),
            ];
            return view('page/laundry/payment', $data);
        } else {
            redirect(base_url('home'));
        }
    }

    public function getInvoice($id)
    {
        $row = $this->laundry->getLaundry($id);
        if ($row) {
            $data  = [
                'laundry' => $row,
                'title' =>  'Invoice Laundry',
                'now' =>  Time::now(),
            ];
            return view('page/laundry/invoice', $data);
        } else {
            redirect(base_url('home'));
        }
    }

    public function getservice($id)
    {
        $detailProduk = $this->service->getDetailservice($id);
        echo json_encode($detailProduk[0]);
        return true;
    }

    public function updateActivity($id)
    {
        $data = array(
            'activity_id'    => $this->request->getPost('id_activity'),
            'updated_at'    => Time::now(),
        );

        $save = $this->laundry->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Status laundry berhasil diubah');
            return redirect()->to(base_url('laundry'));
        }
    }

    public function updatePaid($id)
    {
        $price = (float)$this->request->getVar('price');
        $paid = (float)$this->request->getVar('paid');
        // $result = (float)$this->request->getVar('result');
        $hasil = (float)$this->request->getVar('sisa') + $paid;
        if ($hasil < $price) {
            $kembalian = $price - $hasil;
            $total = $hasil;
            $status = 'Belum Lunas';
        } else if ($hasil == $price) {
            $kembalian = 0;
            $total = $price;
            $status = 'Lunas';
        } else if ($price < $hasil) {
            $kembalian = $paid - $price;
            $total = $price;
            $status =  'Lunas';
        }
        $data = array(
            'paid'   => $hasil,
            'status'   => $status,
            'result' => $kembalian,
            'total' => $total,
            'updated_at'    => Time::now(),
        );

        $save = $this->laundry->update($id, $data);
        if ($save) {
            session()->setFlashdata('success', 'Status laundry berhasil diubah');
            return redirect()->to(base_url('laundry/invoice/' . $id));
        }
    }
}
