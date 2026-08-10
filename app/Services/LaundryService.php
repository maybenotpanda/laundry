<?php

namespace App\Services;

use Exception;

use App\Models\Laundry\TransactionsModel;
use App\Models\Laundry\TransactionDetailsModel;
use App\Models\Customer_model;
use App\Models\Service_model;

class LaundryService
{
  protected TransactionsModel $transactions;
  protected TransactionDetailsModel $details;
  protected Customer_model $customers;
  protected Service_model $services;

  public function __construct()
  {
    $this->transactions = new TransactionsModel();
    $this->details = new TransactionDetailsModel();
    $this->customers = new Customer_model();
    $this->services = new Service_model();
  }

  public function create(array $request)
  {
    $customer = $this->customers->find($request['customer_id']);
    if (!$customer) {
      throw new Exception(
        'Pelanggan tidak ditemukan'
      );
    }

    $details        = $this->calculateDetails($request);
    $transactionId  = $this->insertTransaction($request, $details);

    return $transactionId;
  }

  private function calculateDetails(array $request)
  {
    $total        = 0;
    $details      = [];
    $serviceList  = [];

    $serviceIds = array_column($request['details'], 'service_id');
    $services = $this->services->whereIn('id', $serviceIds)->findAll();

    if (!$services) {
      throw new Exception(
        'Layanan tidak tersedia'
      );
    }

    foreach ($services as $service) {
      $serviceList[$service['id']] = $service;
    }

    foreach ($request['details'] as $detail) {
      $service = $serviceList[$detail['service_id']] ?? null;
      if (!$service) {
        throw new Exception(
          'Layanan tidak tersedia'
        );
      }

      $price          = $service['price'];
      $subTotal       = $price * $detail['weight'];
      $total          += $subTotal;
      $completedDate  = date('Y-m-d', strtotime("+" . $service['day'] . " days"));

      $details[] = [
        'service_id'    => $service['id'],
        'weight'        => $detail['weight'],
        'qty'           => $detail['qty'],
        'price'         => $price,
        'subtotal'      => $subTotal,
        'status'        => $detail['status'],
        'description'   => $detail['description'] ?? null,
        'completed_at'  => $completedDate
      ];
    }
    return [
      'total_amount' => $total,
      'details' => $details
    ];
  }

  private function insertTransaction(
    array $request,
    array $details
  ): int {

    $invoice = 'TRX-' . date('YmdHis');

    $transactionId = $this->transactions
      ->insert([
        'user_id' => $request['user_id'],
        'customer_id' => $request['customer_id'],
        'invoice' => $invoice,
        'total_amount' => $details['total_amount'],
        'paid_amount' => 0,
        'payment_status' => 'Unpaid'
      ]);

    foreach ($details['details'] as $detail) {
      $this->details->insert([
        'transaction_id' => $transactionId,
        'service_id' => $detail['service_id'],
        'weight' => $detail['weight'],
        'qty' => $detail['qty'],
        'price' => $detail['price'],
        'subtotal' => $detail['subtotal']
      ]);
    }
    return $transactionId;
  }

  public function getDashboard()
  {
    $monthStart = date('Y-m-01 00:00:00');
    $monthEnd   = date('Y-m-t 23:59:59');

    return [
      'get_laundry'             => $this->transactions->getLaundry(),
      'process_transactions'    => $this->transactions->countTransactions($monthStart, $monthEnd, 'Process'),
      'completed_transactions'  => $this->transactions->countTransactions($monthStart, $monthEnd, 'Finishing'),
      'monthly_transactions'    => $this->transactions->countMonthlyTransactions($monthStart, $monthEnd),
      'previous_transactions'   => $this->transactions->countPreviousTransactions($monthStart),
      // 'outcome'                 => $this->transactions->countMonthlyRevenue($monthStart, $monthEnd)
    ];
  }

  public function getInvoice(int $id)
  {
    $transaction = $this->transactions->getTransactionById($id);
    if (!$transaction) {
      return null;
    }

    $transaction['details'] = $this->details->getByTransactionId($id);

    return $transaction;
  }
}
