<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_item_id'  => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'auto_increment'        => true,
                'null'                  => false,
            ],
            'order_id'       => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => false,
            ],
            'product_id'     => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => true,
            ],
            'variant_id'     => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => true,
            ],
            'is_variant'     => [
                'type'                  => 'BOOLEAN',
                'null'                  => true,
                'default'               => false,
            ],
            'quantity'       => [
                'type'                  => 'INT',
                'null'                  => false,
            ],
            'item_total'     => [
                'type'                  => 'DECIMAL',
                'constraint'            => '11,2'
            ],
            'created_at'    => [
                'type'                  => 'DATETIME',
                'null'                  => true
            ],
            'updated_at'    => [
                'type'                  => 'DATETIME',
                'null'                  => true
            ],
            'deleted_at'    => [
                'type'                  => 'DATETIME',
                'null'                  => true
            ],
        ]);
        $this->forge->addKey('order_item_id', TRUE);
        $this->forge->addForeignKey('order_id', 'orders', 'order_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'product_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('variant_id', 'variations', 'variation_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items');
    }
}
