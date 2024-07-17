<?php

namespace App\Models;

use CodeIgniter\Model;

class Laundry_model extends Model
{
    protected $table = 'laundry';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_id',
        'service_id',
        'activity_id',
        'user_id',
        'invoice',
        'weight',
        'price',
        'paid',
        'qty',
        'result',
        'total',
        'note',
        'status',
        'created_at',
        'updated_at',
        'finished_at'
    ];

    public function getLaundry($id = false)
    {
        if ($id === false) {
            return $this
                ->table($this->table)
                ->select('laundry.id as id,
                        invoice, 
                        weight, 
                        laundry.price as price, 
                        paid, 
                        qty,
                        result,
                        status,
                        customer.name as name_customer, 
                        customer.phone as phone_customer,
                        service.name as name_service, 
                        service.price as price_service,
                        activity.name as name_activity, 
                        laundry.created_at as created_at, 
                        finished_at')
                ->join('service', 'service.id = laundry.service_id')
                ->join('customer', 'customer.id = laundry.customer_id')
                ->join('activity', 'activity.id = laundry.activity_id')
                ->orderBy('id', 'desc')
                ->get()->getResultArray();
        } else {
            return $this->db->table('laundry')
                ->where('laundry.id', $id)
                ->select('laundry.id as id,
                        invoice, 
                        weight, 
                        laundry.price as price, 
                        paid, 
                        note,
                        qty,
                        service.price as price_service,
                        result,
                        status,
                        customer.name as name_customer, 
                        customer.address as address_customer, 
                        customer.phone as phone_customer, 
                        service.name as name_service, 
                        activity.name as name_activity, 
                        laundry.created_at as created_at, 
                        finished_at')
                ->join('service', 'service.id = laundry.service_id')
                ->join('customer', 'customer.id = laundry.customer_id')
                ->join('activity', 'activity.id = laundry.activity_id')
                ->orderBy('id', 'desc')
                ->get()->getRowArray();
        }
    }

    public function getDetail($invoice)
    {
        return $this->db->table('laundry')
            ->where('invoice', $invoice)
            ->select('laundry.id as id,
                        invoice, 
                        weight, 
                        laundry.price as price,  
                        paid, 
                        note,
                        customer.name as name_customer, 
                        service.name as name_service, 
                        activity.name as name_activity, 
                        laundry.created_at as created_at, 
                        finished_at')
            // ->select('laundry.id as id, invoice, name_customer, phone_customer, weight, price, note, paid, status,  activity_id, qty, name_service, name_activity, address_customer,  phone_customer, price_service, laundry.created_at as created_at, finished_at')
            ->join('service', 'service.id = laundry.service_id')
            ->join('customer', 'customer.id = laundry.customer_id')
            ->join('activity', 'activity.id = laundry.activity_id')
            ->get()->getRowArray();
    }

    public function insertLaundry($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function getInvoice()
    {
        $code = $this->db->table($this->table)
            ->select('RIGHT(invoice, 4) as invoice', false)
            ->orderBy('invoice', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (empty($code['invoice'])) {
            $no = 1;
        } else {
            $no = intval($code['invoice']) + 1;
        }
        $date = date('Ymd');
        $limit = str_pad($no, 4, "0", STR_PAD_LEFT);
        $inovice = $date . $limit;
        return $inovice;
    }

    public function sumLaundry()
    {
        return $this->db->table($this->table)
            ->selectSum('paid')
            ->get()->getResultArray();
    }

    public function Income()
    {
        return $this
            ->table($this->table)
            ->orderBy('id', 'desc')
            ->select('laundry.id as id,
                        invoice, 
                        weight, 
                        laundry.price as price, 
                        paid, 
                        total,
                        result,
                        customer.name as name_customer, 
                        service.name as name_service, 
                        service.price as price_service,
                        activity.name as name_activity, 
                        laundry.created_at as created_at, 
                        finished_at')
            ->join('service', 'service.id = laundry.service_id')
            ->join('customer', 'customer.id = laundry.customer_id')
            ->join('activity', 'activity.id = laundry.activity_id')
            ->where('status', 'Lunas')
            ->get()->getResultArray();
    }

    public function trakhir()
    {
        return $this->table($this->table)
            ->select('laundry.id as id,
                        invoice, 
                        weight, 
                        laundry.price as price, 
                        paid, 
                        customer.name as name_customer, 
                        service.name as name_service, 
                        activity.name as name_activity, 
                        laundry.created_at as created_at, 
                        finished_at')
            ->join('service', 'service.id = laundry.service_id')
            ->join('customer', 'customer.id = laundry.customer_id')
            ->join('activity', 'activity.id = laundry.activity_id')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get()->getResultArray();
    }

    public function search($keyword)
    {
        return $this->table($this->table)
            ->where('invoice', $keyword)
            ->select('laundry.id as id,
                        invoice, 
                        weight, 
                        laundry.price as price, 
                        paid, 
                        customer.name as name_customer, 
                        phone,
                        status,
                        note,
                        qty,
                        result,
                        service.name as name_service, 
                        service.price as price_service,
                        activity.name as name_activity, 
                        laundry.created_at as created_at,
                        laundry.updated_at as updated_at,
                        finished_at')
            ->join('service', 'service.id = laundry.service_id')
            ->join('customer', 'customer.id = laundry.customer_id')
            ->join('activity', 'activity.id = laundry.activity_id')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
}
