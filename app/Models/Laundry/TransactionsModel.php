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

  public function getLaundry(): array
  {
    return $this
      ->select('
        laundry_transactions.id, laundry_transactions.invoice,
        laundry_transactions.total_amount,
        laundry_transactions.created_at,
        customers.name as customer,
        customers.phone AS phone_number,
        SUM(laundry_transaction_details.weight) AS total_weight,
          CASE
            WHEN SUM(CASE
              WHEN laundry_transaction_details.status = "Process"
                THEN 1
                ELSE 0
              END
            ) > 0
            THEN "Process"

            WHEN SUM(CASE
              WHEN laundry_transaction_details.status = "Finishing"
                THEN 1
                ELSE 0
              END
            ) > 0
            THEN "Finishing"

            WHEN SUM(CASE
              WHEN laundry_transaction_details.status = "Completed"
                THEN 1
                ELSE 0
              END
            ) > 0
            THEN "Completed"

            WHEN SUM(CASE
              WHEN laundry_transaction_details.status = "Taken"
                THEN 1
                ELSE 0
              END
            ) > 0
            THEN "Taken"

          ELSE "Process"
        END AS status
      ')
      ->join('customers', 'customers.id = laundry_transactions.customer_id')
      ->join('laundry_transaction_details', 'laundry_transactions.id = laundry_transaction_details.transaction_id', 'left')
      ->groupBy('laundry_transactions.id')
      ->orderBy('laundry_transactions.updated_at', 'DESC')
      ->findAll();
  }

  public function getTransactionById(int $id): ?array
  {
    return $this
      ->select('
        laundry_transactions.id,
        laundry_transactions.invoice,
        laundry_transactions.total_amount,
        laundry_transactions.paid_amount,
        laundry_transactions.payment_status,
        laundry_transactions.created_at,
        laundry_transactions.updated_at,
        customers.name as customer,
        customers.phone as phone_number,
        customers.address
      ')
      ->join('customers', 'customers.id = laundry_transactions.customer_id')
      ->where('laundry_transactions.id', $id)
      ->first();
  }

  /**
   * Function count
   */
  public function countTransactions(
    string $start,
    string $end,
    string $status
  ): int {
    return $this
      ->where('laundry_transactions.updated_at >=', $start)
      ->where('laundry_transactions.updated_at <=', $end)
      ->whereNotIn(
        'laundry_transactions.id',
        function ($builder) use ($status) {
          return $builder
            ->select('transaction_id')
            ->from('laundry_transaction_details')
            ->where('status !=', $status);
        }
      )->countAllResults();
  }

  public function countMonthlyTransactions(string $start, string $end): int
  {
    return $this->where('created_at >=', $start)->where('created_at <=', $end)->countAllResults();
  }

  public function countPreviousTransactions(string $start): int
  {
    return $this->where('created_at <', $start)->countAllResults();
  }

  public function countMonthlyRevenue(string $start, string $end): int
  {
    return $this->where('payment_status', 'Paid')->where('created_at >=', $start)->where('created_at <=', $end)->countAllResults();
  }
}
