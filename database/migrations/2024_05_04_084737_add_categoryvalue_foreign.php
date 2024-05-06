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
            ->foreign('category_id')
            ->references('id')
            ->on('categoryparentproducts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categoryvalues',function(Blueprint $table) {
            $table->dropForeign('categoryvalues_category_id_foreign');
        });
    }
};
