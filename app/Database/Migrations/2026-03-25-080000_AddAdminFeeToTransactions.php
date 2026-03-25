<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminFeeToTransactions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transactions', [
            'admin_fee' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'amount',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transactions', 'admin_fee');
    }
}
