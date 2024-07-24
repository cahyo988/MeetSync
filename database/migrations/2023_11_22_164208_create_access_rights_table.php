<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('access_rights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id_atasan');
            $table->unsignedBigInteger('role_id_bawahan');
            $table->unsignedBigInteger('todo_id')->nullable();
            $table->timestamps();

            $table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');
            $table->foreign('role_id_atasan')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('role_id_bawahan')->references('id')->on('roles')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('access_rights');
    }
};
