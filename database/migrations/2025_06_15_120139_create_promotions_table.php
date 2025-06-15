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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("details")->nullable();
            $table->float("price", 26, 4)->nullable();
            $table->float("porcentage", 5, 2)->nullable();
            $table->foreignId("client_id")->nullable()->index()->onDelete('cascade');
            $table->foreignId("product_id")->nullable()->index()->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
