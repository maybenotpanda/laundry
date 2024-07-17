<?php

namespace App\Models;

use CodeIgniter\Model;

class Activity_model extends Model
{
    protected $table = 'activity';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function getActivity($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    public function insertActivity($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}
