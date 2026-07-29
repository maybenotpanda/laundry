<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomers extends Migration
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
            'name' => [
                'type'              => 'varchar',
                'constraint'        => 255,
            ],
            'address'   => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'phone' => [
                'type'              => 'varchar',
                'constraint'        => 50,
                'null'              => true
            ],
            'created_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
            'updated_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
            'deleted_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
        ]);

        $this->forge->addKey(
            'id',
            TRUE
        );

        $this->forge->createTable(
            'customers',
            TRUE
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'customers'
        );
    }
}
