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
        Schema::table('orderdetail',function(Blueprint $table) {
            $table
            ->foreign('order_id')
            ->references('id')
            ->on('orders');

            $table
            ->foreign('product_id')
            ->references('id')
            ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orderdetail',function(Blueprint $table) {
            $table->dropForeign('orderdetail_order_id_foreign');
            $table->dropForeign('orderdetail_product_id_foreign');
        });
    }
};
