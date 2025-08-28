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
Schema::create('stock_transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->integer('quantity');
    $table->enum('type', ['masuk', 'keluar']);
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // yang input
    $table->string('note')->nullable();

    // tambahan
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); 
    $table->foreignId('checked_by')->nullable()->constrained('users')->onDelete('set null'); // staff yg verifikasi

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
