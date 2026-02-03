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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 0)->nullable();
            $table->unsignedBigInteger('shppment_adress_id', 0);
            $table->unsignedBigInteger('payment_id', 0);
            $table->string('status')->default('received');
            $table->string('trcking_id')->default('unset');
            $table->foreign('shppment_adress_id')->references('id')->on('adresses');
            $table->string('name')->nullable();    // For guest name
            $table->string('email')->nullable();
            $table->string('phone')->nullable();   // For guest email
            $table->foreign('payment_id')->references('id')->on('paypalpayments');
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
        Schema::dropIfExists('orders');
    }
};
