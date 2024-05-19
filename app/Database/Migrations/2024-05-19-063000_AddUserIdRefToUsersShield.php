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
            'ref_user_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'null'              => false,
                'unique'            => true,
            ],
        ];

        $this->forge->addColumn($this->tables['users'], $fields);

        // * TODO: code below does not work
        // $this->forge->addForeignKey('ref_user_id', 'users', 'user_id', 'CASCADE', 'CASCADE', 'fk_auth_user_id');
    }

    public function down()
    {
        $fields = [
            'ref_user_id',
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
