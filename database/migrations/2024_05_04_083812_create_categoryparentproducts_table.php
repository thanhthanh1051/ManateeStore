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
        Schema::create('categoryparentproducts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_parent')->nullable()->unsigned();
            $table->bigInteger('category_product')->nullable()->unsigned();
            $table->timestamps();
            $table->unique(['category_parent', 'category_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoryparentproducts');
    }
};
