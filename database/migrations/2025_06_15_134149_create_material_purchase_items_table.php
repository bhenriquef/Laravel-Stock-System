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
        Schema::create('material_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->index()->onDelete('cascade');
            $table->foreignId("material_purchase_id")->index()->onDelete('cascade');
            $table->foreignId('shipping_id')->nullable();
            $table->integer('quantity');
            $table->float('price', 26, 4);
            $table->float('total', 26, 4);
            $table->float('shipping_price', 26, 4)->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->integer('delivery_time')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_purchase_items');
    }
};
