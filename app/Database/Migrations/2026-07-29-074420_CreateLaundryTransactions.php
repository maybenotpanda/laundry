<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaundryTransactions extends Migration
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
            'customer_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true
            ],
            'user_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true
            ],
            'invoice' => [
                'type'              => 'varchar',
                'constraint'        => 50,
                'null'              => true
            ],
            'total_amount' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12,2',
                'default'           => 0,
            ],
            'paid_amount' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12,2',
                'default'           => 0,
            ],
            'payment_status' => [
                'type'              => 'ENUM',
                'constraint'        => ['Unpaid', 'Partial', 'Paid'],
            ],
            'created_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
            'updated_at' => [
                'type'              => 'datetime',
                'null'              => true
            ]
        ]);

        $this->forge->addKey(
            'id',
            TRUE
        );

        $this->forge->addForeignKey(
            'customer_id',
            'customers',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable(
            'laundry_transactions',
            TRUE
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'laundry_transactions'
        );
    }
}
