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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_product_id')->constrained()->cascadeOnDelete();
            $table->string('voted_by_telegram_id');
            $table->timestamps();

            $table->unique(['group_product_id', 'voted_by_telegram_id']); // Prevent duplicate votes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
