<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username')->primary(); // Make 'username' the primary key
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('role_id')->notNull();
            $table->unsignedBigInteger('employee_id')->notNull();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles') ->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees') ->onDelete('cascade'); 
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
