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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->index()->onDelete('cascade');
            $table->foreignId('sale_id')->index()->onDelete('cascade');
            $table->float('initial_price', 26, 4);
            $table->float('final_price', 26, 4);
            $table->float('discount', 26, 4)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_products');
    }
};
