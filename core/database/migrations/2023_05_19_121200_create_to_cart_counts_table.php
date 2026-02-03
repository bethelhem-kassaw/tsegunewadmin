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
        Schema::create('to_cart_counts', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('ip_adress')->nullable();
            $table->integer('count_per_day')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('to_cart_counts');
    }
};
