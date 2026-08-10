<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Customer_model;
use App\Models\Service_model;
use App\Services\LaundryService;
use App\Validators\TransactionValidator;

class TransactionController extends BaseController
{
  protected Customer_model $customers;
  protected Service_model $services;
  protected LaundryService $laundryService;
  protected TransactionValidator $validatorTransaction;

  public function __construct()
  {
    $this->customers = new Customer_model();
    $this->services = new Service_model();
    $this->validatorTransaction = new TransactionValidator();
    $this->laundryService = new LaundryService();
  }

  public function create()
  {
    $data  = [
      'title'     => 'Tambah Laundry',
      'customers' => $this->customers->getCustomer(),
      'services'  => $this->services->getService(),
      'time'      => $this->time,
    ];
    return view('page/laundry/add-transaction', $data);
  }

  public function store()
  {
    $details = [];

    $serviceIds = $this->request->getPost('serviceIds');
    $weight = $this->request->getPost('weight');
    $qty = $this->request->getPost('qty');
    $description = $this->request->getPost('description');

    foreach ($serviceIds as $key => $serviceId) {
      $details[] = [
        'service_id' => $serviceId ?? '',
        'weight' => $weight[$key] ?? '',
        'qty' =>  $qty[$key] ?? '',
        'status' => 'Process',
        'description' => $description[$key]
      ];
    }

    $data = [
      'user_id'     => $this->request->getPost('userId'),
      "customer_id" => $this->request->getPost('customerId'),
      "details"     => $details
    ];

    if (!$this->validation->setRules($this->validatorTransaction->create())->run($data)) {
      // return $this->response
      //   ->setStatusCode(422)
      //   ->setJSON([
      //     'responseCode' => '001',
      //     'message' => 'The provided data failed validation',
      //     'errors' => $this->validation->getErrors()
      //   ]);

      return redirect()
        ->to('laundry/transaction/create')
        ->withInput()
        ->with('error', implode('<br>', $this->validation->getErrors()));
    }

    try {
      $result = $this->laundryService->create($data);
      // return $this->response
      //   ->setStatusCode(201)
      //   ->setJSON([
      //     'status' => true,
      //     'data' => $result
      //   ]);
      return redirect()->to('laundry/invoice/' . $result);
    } catch (\Exception $e) {
      // return $this->response
      //   ->setStatusCode(404)
      //   ->setJSON([
      //     'responseCode' => '002',
      //     'message' => 'Not Found',
      //     'errors' => $e->getMessage()
      //   ]);

      return redirect()
        ->to('laundry/transaction/create')
        ->withInput()
        ->with('error', $e->getMessage());
    }
  }
};
