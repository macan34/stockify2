<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'app_name',
                'value' => 'Laravel Inventory',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Nama aplikasi yang ditampilkan di dashboard',
            ],
            [
                'key' => 'app_title',
                'value' => 'Sistem Manajemen Inventory',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Title yang ditampilkan di browser tab',
            ],
            [
                'key' => 'theme',
                'value' => 'light',
                'type' => 'select',
                'group' => 'appearance',
                'description' => 'Tema warna aplikasi',
            ],
            // Tambahkan setting lainnya...
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                $setting + ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}