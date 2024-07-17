<?php

namespace App\Models;

use CodeIgniter\Model;

class Employee_model extends Model
{
    protected $table = 'employee';
    protected $allowedFields = ['first_name', 'last_name', 'address', 'phone', 'salary', 'created_at', 'updated_at'];

    public function getEmployee($id = false)
    {
        if ($id === false) {
            return $this
                ->table($this->table)
                ->select('employee.id as employeeid, 
                            first_name, 
                            last_name, 
                            address, 
                            phone, 
                            username, 
                            salary, 
                            name, 
                            employee.user_id as user_id')
                ->join('users', 'users.id = employee.user_id')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->get()->getResultArray();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }

    public function insertEmployee($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function getDetail($id)
    {
        return $this
            ->table($this->table)
            ->where('user_id', $id)
            ->select('employee.id as employeeid,
                    employee.user_id as user_id,
                    first_name, 
                    last_name, 
                    address,
                    phone')
            ->join('users', 'users.id = employee.user_id')
            ->get()->getRowArray();
    }
}
