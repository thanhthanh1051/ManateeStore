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
        Schema::table('categoryvalues',function(Blueprint $table) {
            $table
            ->foreign('category_product')
            ->references('id')
            ->on('categoryproducts');

            $table
            ->foreign('category_parent')
            ->references('id')
            ->on('categoryparents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categoryvalues',function(Blueprint $table) {
            $table->dropForeign('categoryvalues_category_product_foreign');
            $table->dropForeign('categoryvalues_category_parent_foreign');
        });
    }
};
