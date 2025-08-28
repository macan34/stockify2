<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->unsignedBigInteger('supplier_id')->after('category_id')->nullable();
        $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['supplier_id']);
        $table->dropColumn('supplier_id');
    });
}

};
