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
        Schema::table('products',function(Blueprint $table) {
            $table
            ->foreign('category_parent')
            ->references('id')
            ->on('categoryparents');

            $table
            ->foreign('category_product')
            ->references('id')
            ->on('categoryproducts');

            $table
            ->foreign('category_value')
            ->references('id')
            ->on('categoryvalues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products',function(Blueprint $table) {
            $table->dropForeign('products_category_parent_foreign');
            $table->dropForeign('products_category_product_foreign');
            $table->dropForeign('products_category_value_foreign');
        });
    }
};
