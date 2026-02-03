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
        Schema::table('user_permission', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
        });
        Schema::rename('user_permission', 'stakeholder_permission');

        Schema::table('stakeholder_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('stakeholder_id', 0);
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stakeholder_permission', function (Blueprint $table) {
            //
        });
    }
};
