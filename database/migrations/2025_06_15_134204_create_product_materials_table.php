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
        Schema::create('product_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->index()->onDelete('cascade');
            $table->foreignId("material_id")->index()->onDelete('cascade');
            $table->float('quantity_material', 26, 4);
            $table->float('quantity_product', 26, 4);
            $table->float('production_cost', 26, 4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_materials');
    }
};
