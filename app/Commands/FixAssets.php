<?php

// Fix broken BNI logo URL in database
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class FixAssets extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'fix:assets';
    protected $description = 'Fix broken URLs and assets';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        
        // Fix BNI Logo (Use Dicebear to avoid ORB blocks on localhost)
        $db->table('payment_methods')
           ->where('name', 'BNI')
           ->update(['logo' => 'https://api.dicebear.com/7.x/initials/svg?seed=BNI&backgroundColor=005aab&chars=3']);

        // Fix QRIS (just in case)
        $db->table('payment_methods')
           ->where('name', 'QRIS')
           ->update(['logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg']);

        CLI::write('URLs fixed successfully!', 'green');
    }
}
