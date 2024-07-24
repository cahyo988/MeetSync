<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomNotulensiKeAgenda extends Migration
{
    public function up()
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->boolean('sudah_notulensi')->default(false);
        });
    }

    public function down()
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn('sudah_notulensi');
        });
    }
}