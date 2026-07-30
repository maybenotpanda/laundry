<?php

namespace App\Models\Laundry;

use CodeIgniter\Model;

class TransactionsModel extends Model
{
  protected $table          = 'laundry_transactions';
  protected $primaryKey     = 'id';
  protected $returnType     = 'array';

  protected $allowedFields  = [
    'user_id',
    'customer_id',
    'invoice',
    'total_amount',
    'paid_amount',
    'payment_status'
  ];

  protected $useTimestamps = true;
}
