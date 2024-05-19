<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

/**
 * REFERENCE: https://shield.codeigniter.com/customization/adding_attributes_to_users/
 */

class AddUserIdRefToUsersShield extends Migration
{
    /**
     * @var string[]
     */
    private array $tables;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var \Config\Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up()
    {
        $fields = [
            'student_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'null'              => true,
            ],
        ];

        $this->forge->addColumn($this->tables['users'], $fields);

        // * not sure if this works
        //$this->forge->addForeignKey('student_id', 'students', 'student_id', 'CASCADE', 'CASCADE', 'fk_student_id');
    }

    public function down()
    {
        $fields = [
            'student_id',
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
