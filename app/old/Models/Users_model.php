<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model
{
    protected $table = 'users';

    public function getUsers($id = false)
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
