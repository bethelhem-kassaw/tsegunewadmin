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
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            // $table->string('user_id', 0);
            $table->foreignId('country_id')->references('id')->on('countries');
            $table->foreignId('city_id')->references('id')->on('country_cities');
            $table->foreignId('sub_city_id')->references('id')->on('sub_cities');
            $table->string('fullname');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('posta_number')->nullable();
            // $table->string('province_code')->nullable();
            // $table->string('province_name')->nullable();
            $table->string('addressLine1')->nullable();
            $table->string('addressLine2')->nullable();
            $table->string('addressLine3')->nullable();
            // $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('adresses');
    }
};
