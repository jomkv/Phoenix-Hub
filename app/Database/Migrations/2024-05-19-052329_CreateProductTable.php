<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        $fields = [
            'product_id' => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'auto_increment'        => true,
                'null'                  => false,
            ],
            'product_name' => [
                'type'                  => 'VARCHAR',
                'constraint'            => '255',
                'null'                  => false,
            ],
            'description' => [
                'type'                  => 'TEXT',
                'null'                  => false,
            ],
            'price' => [
                'type'                  => 'DECIMAL',
                'constraint'            => '10,2',
                'null'                  => false,
            ],
            'image_urls' => [ // Store comma-separated image URLs here
                'type'                  => 'TEXT',
                'null'                  => true,
            ],
            'stock' => [
                'type'                  => 'INT',
                'null'                  => false,
            ],
            'organization_id' => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => false,
            ],
            'is_deleted' => [
                'type'                  => 'BOOLEAN',
                'null'                  => false,
                'default'               => false,
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('product_id');
        $this->forge->addForeignKey('organization_id', 'organizations', 'organization_id', 'CASCADE', 'CASCADE', 'fk_product_org');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
