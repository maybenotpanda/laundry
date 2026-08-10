<?php

namespace App\Models\Laundry;

use CodeIgniter\Model;

class TransactionDetailsModel extends Model
{
  protected $table          = 'laundry_transaction_details';
  protected $primaryKey     = 'id';
  protected $returnType     = 'array';

  protected $allowedFields  = [
    'transaction_id',
    'service_id',
    'weight',
    'qty',
    'price',
    'subtotal',
    'description',
    'completed_at',
    'pickup_date'
  ];

  protected $useTimestamps = true;

  public function getByTransactionId(int $transactionId): array
  {
    return $this
      ->select('laundry_transaction_details.*, service.name as service_name')
      ->join('service', 'service.id = ' . 'laundry_transaction_details.service_id')
      ->where('laundry_transaction_details.transaction_id', $transactionId)
      ->orderBy('laundry_transaction_details.id', 'ASC')
      ->findAll()
    ;
  }
}
