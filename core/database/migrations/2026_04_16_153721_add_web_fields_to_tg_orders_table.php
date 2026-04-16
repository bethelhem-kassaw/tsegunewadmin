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
        Schema::table('tg_orders', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('telegram_username');
            $table->string('phone_number')->nullable()->after('full_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tg_orders', function (Blueprint $table) {
            //
        });
    }
};
