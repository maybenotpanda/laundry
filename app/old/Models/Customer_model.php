<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer_model extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'address', 'phone'];

    public function getCustomer($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    public function insertCustomer($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}
