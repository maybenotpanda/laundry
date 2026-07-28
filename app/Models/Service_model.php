<?php

namespace App\Models;

use CodeIgniter\Model;

class  Service_model extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'price', 'day'];

    public function getService($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }
    public function insertService($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function getPrice($id)
    {
        return $this->db->table($this->table)->getWhere(['id' => $id])->getRowArray();
    }

    public function getDetailservice($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get()->getResultArray();
    }
}
