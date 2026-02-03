<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_providers', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name');
            $table->string('provider_phone');
            $table->string('description')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('license_url')->nullable();
            $table->string('moto')->nullable();
            $table->integer('rate', 0)->default(4);
            $table->integer('review_count')->default(1);
            $table->string('status')->default('pending');
            $table->foreignId('adress_id')->nullable()->constrained('adresses')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sell_providers', function (Blueprint $table) {
            //
        });
    }
};
