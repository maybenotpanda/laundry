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
}
