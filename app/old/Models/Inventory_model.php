<?php

namespace App\Models;

use CodeIgniter\Model;

class Inventory_model extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'price',
        'qty',
        'total',
        'unit',
        'status',
        'note',
        'created_by',
        'updated_by'
    ];

    public function getInventory($id = false)
    {
        if ($id === false) {
            return $this
                ->table($this->table)
                ->select('inventory.id as id, 
                        inventory.status as status, 
                        inventory.created_at as created_at, 
                        username, 
                        invoice, 
                        name, 
                        price, 
                        qty, 
                        total,
                        unit,
                        note,
                        ')
                ->join('users', 'users.id = inventory.user_id')
                ->orderBy('id', 'desc')
                ->get()->getResultArray();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    public function getInvoice()
    {
        $code = $this->db->table($this->table)
            ->select('RIGHT(invoice, 3) as invoice', false)
            ->orderBy('invoice', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (empty($code['invoice'])) {
            $no = 1;
        } else {
            $no = intval($code['invoice']) + 1;
        }
        $date = date('Ymd');
        $limit = str_pad($no, 3, "0", STR_PAD_LEFT);
        $inovice = $date . $limit;
        return $inovice;
    }

    public function insertInventory($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function approvalInventory()
    {
        return $this
            ->table($this->table)
            ->orderBy('id', 'desc')
            ->where('status', 'Diterima')
            ->get()->getResultArray();
    }
}
