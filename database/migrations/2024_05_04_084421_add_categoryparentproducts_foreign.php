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
        Schema::table('categoryparentproducts',function(Blueprint $table) {
            $table
            ->foreign('category_parent')
            ->references('id')
            ->on('categoryparents');

            $table
            ->foreign('category_product')
            ->references('id')
            ->on('categoryproducts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categoryparentproducts',function(Blueprint $table) {
            $table->dropForeign('categoryparentproducts_category_parent_foreign');
            $table->dropForeign('categoryparentproducts_category_product_foreign');
        });
    }
};
