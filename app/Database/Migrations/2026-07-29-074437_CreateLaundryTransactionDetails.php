<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaundryTransactionDetails extends Migration
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
            'service_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true
            ],
            'weight' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12,2',
                'default'           => 0,
            ],
            'qty' => [
                'type'              => 'INT',
                'constraint'        => 11,
            ],
            'price' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12,2',
                'default'           => 0,
            ],
            'subtotal' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12,2',
                'default'           => 0,
            ],
            'status' => [
                'type'              => 'ENUM',
                'constraint'        => ['Process', 'Finishing', 'Taken'],
            ],
            'description' => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'completed_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
            'pickup_date' => [
                'type'              => 'datetime',
                'null'              => true
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
            'transaction_id',
            'laundry_transactions',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'service_id',
            'service',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable(
            'laundry_transaction_details',
            TRUE
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'laundry_transaction_details'
        );
    }
}
