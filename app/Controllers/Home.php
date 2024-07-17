<?php

namespace App\Controllers;

use App\Models\Service_model;
use App\Models\Laundry_model;

class Home extends BaseController
{
    protected $service;
    protected $laundry;
    public function __construct()
    {
        $this->service = new Service_model();
        $this->laundry = new Laundry_model();
    }
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $data  = [
            'service' => $this->service->getService(),
            'laundry'  => $this->laundry->search($keyword)
        ];
        return view('index', $data);
    }

    public function detail($keyword)
    {
        $data  = [
            'laundry'  => $this->laundry->search($keyword)
        ];
        return view('invoice.php', $data);
    }

    public function login()
    {
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }


    public function donothaveaccess()

    {
        $data  = [
            'title' =>  'Do Not Have Access',
        ];
        return view('donothaveaccess', $data);
    }
}
