<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderTable extends Migration
{
    public function up()
    {
        $fields = [
            'order_id' => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'auto_increment'        => true,
                'null'                  => false,
            ],
            'student_id' => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => false,
            ],
            'status' => [              // pending, processing, completed, cancelled
                'type'                  => 'VARCHAR',
                'constraint'            => '255',
                'null'                  => true,
                'default'               => 'pending',
            ],
            'total' => [
                'type'                  => 'INT',
                'null'                  => false,
            ],
            'payment_method' => [      // COD, Online
                'type'                  => 'VARCHAR',
                'constraint'            => '255',
                'null'                  => false,
            ],
            'payment_reference' => [   // Transaction ID (if necessary)
                'type'                  => 'VARCHAR',
                'constraint'            => '255',
                'null'                  => true,
            ],
            'is_paid' => [
                'type'                  => 'BOOLEAN',
                'null'                  => true,
                'default'               => false
            ],
            'pickup_date' => [
                'type'                  => 'DATETIME',
                'null'                  => false,
            ],
            'deleted_at' => [
                'type'                  => 'DATETIME',
                'null'                  => true,
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('order_id');
        $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_order_student');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
