<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cart_item_id'  => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'auto_increment'        => true,
                'null'                  => false,
            ],
            'student_id'       => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => false,
            ],
            'product_id'     => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'null'                  => false,
            ],
            'quantity'       => [
                'type'                  => 'INT',
                'null'                  => false,
            ],
        ]);

        $this->forge->addKey('cart_item_id', TRUE);
        $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'product_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cart_items');
    }

    public function down()
    {
        $this->forge->dropTable('cart_items');
    }
}
