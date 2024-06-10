<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrganizationTable extends Migration
{
    public function up()
    {
        $fields = [
            'organization_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
                'null'              => false
            ],
            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => false,
            ],
            'full_name' => [
                'type'              => 'TEXT',
                'null'              => false,
            ],
            'contact_email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => false,
            ],
            'contact_person' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'null'              => false,
            ],
            'logo' => [
                'type'              => 'VARCHAR',
                'constraint'        => '500',
                'null'              => false,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ]
        ];

        $this->forge->addField($fields);

        $this->forge->addPrimaryKey('organization_id');

        $this->forge->createTable('organizations');
    }

    public function down()
    {
        $this->forge->dropTable('organizations');
    }
}
