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
        if (!Schema::hasColumn('stock_physical')) {
            $table->integer('stock_physical')->default(0)->after('stock_system');
        }
    });
}
    }

    public function down(): void
    {
        Schema::table('stock_opnames', function (Blueprint $table) {
            $table->dropColumn('stock_physical');
        });
    }
};
