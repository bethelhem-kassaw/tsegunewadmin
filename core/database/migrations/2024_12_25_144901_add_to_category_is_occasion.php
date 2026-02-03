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

            Schema::table('main_categories', function (Blueprint $table) {
                $table->boolean('Is_occasion')->default(0);
               
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_is_occasion', function (Blueprint $table) {
            //
        });
    }
};
