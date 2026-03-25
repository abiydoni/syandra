<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // 1. Admin User
        $userModel = new \App\Models\UserModel();
        $userModel->insert([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);

        // 2. Profile
        $profileModel = new \App\Models\ProfileModel();
        $profileId = $profileModel->insert([
            'username'         => 'pink_creators',
            'full_name'        => 'Pink Creator Indonesia',
            'bio'              => 'terimaaciii orang baiksss💗',
            'photo'            => 'https://i.pravatar.cc/150?u=pink',
            'header_image'     => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=800&q=80',
            'greeting_message' => 'Selamat datang di halaman dukungan saya!',
            'instagram'        => 'pink_creators',
            'whatsapp'         => '08123456789',
            'tiktok'           => 'pink_tiktok',
        ]);

        // 3. Social Links
        $socialLinkModel = new \App\Models\SocialLinkModel();
        $socialLinkModel->insert([
            'profile_id'    => $profileId,
            'platform_name' => 'Instagram',
            'url'          => 'https://instagram.com/pink_creators',
            'icon_class'   => 'logo-instagram',
        ]);

        // 4. Nominals (Pink Theme)
        $nominalModel = new \App\Models\NominalModel();
        $nominals = [
            ['amount' => 5000,   'label' => '5k',   'color' => 'bg-pink-100'],
            ['amount' => 15000,  'label' => '15k',  'color' => 'bg-pink-300'],
            ['amount' => 3000,   'label' => '30k',  'color' => 'bg-pink-400'],
            ['amount' => 100000, 'label' => '100k', 'color' => 'bg-pink-500 text-white'],
        ];
        foreach ($nominals as $nominal) {
            $nominalModel->insert($nominal);
        }

        // 5. Payment Methods
        $pmModel = new \App\Models\PaymentMethodModel();
        $methods = [
            ['name' => 'QRIS', 'type' => 'ewallet', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg', 'fee_percent' => 0.70, 'fee_fixed' => 0, 'bg_color' => '#fbcfe8'],
            ['name' => 'Gopay', 'type' => 'ewallet', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg', 'fee_percent' => 2.00, 'fee_fixed' => 0, 'bg_color' => '#fce7f3'],
            ['name' => 'OVO', 'type' => 'ewallet', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg', 'fee_percent' => 2.74, 'fee_fixed' => 0, 'bg_color' => '#fce7f3'],
            ['name' => 'Mandiri', 'type' => 'va', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg', 'fee_percent' => 0, 'fee_fixed' => 4500, 'bg_color' => '#fdf2f8'],
            ['name' => 'BNI', 'type' => 'va', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg', 'fee_percent' => 0, 'fee_fixed' => 4500, 'bg_color' => '#fdf2f8'],
        ];
        foreach ($methods as $method) {
            $pmModel->insert($method);
        }
    }
}
