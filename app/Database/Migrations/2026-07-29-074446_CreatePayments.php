<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'transaction_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'amount' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12,2',
                'default'           => 0,
            ],
            'payment_method' => [
                'type'              => 'ENUM',
                'constraint'        => ['Cash', 'Transfer', 'QRIS'],
            ],
            'created_by' => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'payment_date' => [
                'type'              => 'datetime',
                'null'              => true
            ],
            'created_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
