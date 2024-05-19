<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentTable extends Migration
{
    public function up()
    {
        $fields = [
            'student_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
                'null'              => false
            ],
            'username' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50',
                'null'              => false,
                'unique'            => true,
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => false,
                'unique'            => true,
            ],
            'student_number' => [
                'type'              => 'VARCHAR',
                'constraint'        => '10',
                'null'              => false,
                'unique'            => true,
            ],
            'first_name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50',
                'null'              => false,
            ],
            'last_name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '50',
                'null'              => false,
            ],
            'pfp_url' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => true,
            ]
        ];

        $this->forge->addField($fields);

        $this->forge->addPrimaryKey('student_id');

        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}