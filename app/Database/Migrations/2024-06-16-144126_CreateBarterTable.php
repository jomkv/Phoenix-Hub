<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

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
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false,
            ],
            'price' => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'           => true,
            ],
            'images' => [           // Store stringified JSON of cloudinary images here
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
                'default'        => 'pending'
            ],
            'date' => [
                'type'          => 'DATE',
                'default'       => new RawSql('CURRENT_DATE'),
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('barter_id');
        $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('barter_posts');
    }

    public function down()
    {
        $this->forge->dropTable('barter_posts');
    }
}
