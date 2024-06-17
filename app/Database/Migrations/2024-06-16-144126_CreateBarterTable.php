<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarterTable extends Migration
{
    public function up()
    {
        $fields = [
            'barter_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false,
            ],
            'student_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'           => false,
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'barter_category' => [
                'type'           => 'ENUM',
                'constraint'     => ['swap', 'For Sale'],
                'null'           => false,
            ],
            'price' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'           => false,
            ],
            'images' => [ // Store stringified JSON of cloudinary images here
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'    => ['Approved', 'Cancelled', 'Pending'],
                'null'           => true,
                'default'        =>'Pending'
            ],
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('barter_id');
        $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('barter_posts'); // Corrected table name: barter_posts instead of barter_posts
    }

    public function down()
    {
        $this->forge->dropTable('barter_posts');
    }
}
