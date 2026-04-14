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
        Schema::create('tg_orders', function (Blueprint $table) {
            $table->id();
            $table->string('telegram_id'); // From Telegram WebApp initData
            $table->string('telegram_username')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('clothing_category'); // men, women, or children
            $table->json('measurements'); // This stores the custom sizes
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
