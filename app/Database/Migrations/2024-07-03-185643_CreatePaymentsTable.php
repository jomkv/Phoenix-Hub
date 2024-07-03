<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id'  => [
                'type'                  => 'INT',
                'unsigned'              => true,
                'auto_increment'        => true,
                'null'                  => false,
            ],
            'amount'      => [
                'type'                  => 'DECIMAL',
                'null'                  => false,
            ],
            'email'      => [
                'type'                  => 'VARCHAR',
                'constraint'            => 255,
                'null'                  => false,
            ],
            'full_name' => [
                'type'                  => 'VARCHAR',
                'constraint'            => 255,
                'null'                  => false,
            ],
            'date' => [
                'type'          => 'DATE',
                'default'       => new RawSql('CURRENT_DATE'),
            ]
        ]);

        $this->forge->addKey('payment_id', TRUE);
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
