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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->index()->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->index();
            $table->foreignId('shipping_id')->nullable();
            $table->float('initial_price', 26, 4);
            $table->float('final_price', 26, 4);
            $table->float('shipping_price', 26, 4)->nullable();
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
        Schema::dropIfExists('sales');
    }
};
