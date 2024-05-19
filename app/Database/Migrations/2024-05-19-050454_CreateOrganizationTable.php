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
            'organization_name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => false,
                'unique'            => true,
            ],
            'description' => [
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
            'logo_url' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => true,
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
