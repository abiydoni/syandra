<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNominalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'amount' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'bg-blue-500',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('nominals');
    }

    public function down()
    {
        $this->forge->dropTable('nominals');
    }
}
