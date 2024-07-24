<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaEmployeeTable extends Migration
{
    public function up()
    {
        Schema::create('agenda_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('agenda_id');
            $table->unsignedBigInteger('employee_id');
            $table->boolean('absensi')->default(0);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agenda_employee');
    }
}
