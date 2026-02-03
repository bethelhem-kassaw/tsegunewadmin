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
        // Schema::table('role_user', function (Blueprint $table) {
        //     $table->dropForeign(['user_id']);
        //     $table->dropColumn(['user_id']);
        // });

        // Schema::rename('role_user', 'stakeholder_role');

        Schema::create('stakeholder_role', function (Blueprint $table) {
            $table->unsignedBigInteger('stakeholder_id', 0);
            $table->unsignedBigInteger('role_id', 0);
            $table->string('status', 10)->default('pending');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('stakeholder_role');
        
    }
};
