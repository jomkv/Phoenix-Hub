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
                'constraint'        => '255',
                'null'              => false,
                'unique'            => true,
            ],
            'full_name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => false,
            ],
            'phone_number' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => false,
            ],
            'pfp' => [
                'type'              => 'VARCHAR',
                'constraint'        => '500',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
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
