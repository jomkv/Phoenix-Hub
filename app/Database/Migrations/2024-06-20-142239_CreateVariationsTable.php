<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVariationsTable extends Migration
{
    public function up()
    {
        $fields = [
            'variation_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false,
            ],
            'product_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'           => false,
            ],
            'variation_name' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'           => false,
            ],
            'price' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'           => false,
            ],
            'stock' => [
                'type'           => 'INT',
                'null'           => false,
            ],
            'deleted_at'    => [
                'type'           => 'DATETIME',
                'null'           => true
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('variation_id');
        $this->forge->addForeignKey('product_id', 'products', 'product_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('variations');
    }

    public function down()
    {
        $this->forge->dropTable('variations');
    }
}
