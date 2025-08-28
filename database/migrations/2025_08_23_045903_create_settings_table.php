<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Key pengaturan, contoh: 'app_name'
            $table->text('value')->nullable(); // Nilai pengaturan
            $table->string('type')->default('text'); // Tipe data: text, image, select, etc.
            $table->string('group')->default('general'); // Grup pengaturan
            $table->text('description')->nullable(); // Deskripsi pengaturan
            $table->timestamps();
        });

        // Insert data default
        DB::table('settings')->insert([
            [
                'key' => 'app_name',
                'value' => 'Laravel Inventory',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Nama aplikasi yang ditampilkan di dashboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'app_title',
                'value' => 'Sistem Manajemen Inventory',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Title yang ditampilkan di browser tab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'theme',
                'value' => 'light',
                'type' => 'select',
                'group' => 'appearance',
                'description' => 'Tema warna aplikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'logo',
                'value' => null,
                'type' => 'image',
                'group' => 'appearance',
                'description' => 'Logo aplikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'favicon',
                'value' => null,
                'type' => 'image',
                'group' => 'appearance',
                'description' => 'Favicon aplikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};