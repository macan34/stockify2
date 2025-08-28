<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('stock_opnames')) {
    Schema::table('stock_opnames', function (Blueprint $table) {
        if (!Schema::hasColumn('stock_system')) {
            $table->integer('stock_system')->default(0)->after('product_id');
        }
    });
}
    }

    public function down(): void
    {
        Schema::table('stock_opnames', function (Blueprint $table) {
            $table->dropColumn('stock_system');
        });
    }
};
