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
       // Contoh migrasi untuk tabel todos
Schema::create('todos', function (Blueprint $table) {
    $table->id();
    $table->text('pesan');
    $table->unsignedBigInteger('creator_id');
    $table->unsignedBigInteger('penerima_id');
    $table->date('deadline')->nullable()->default(null);
    $table->enum('status', ['belum_selesai', 'selesai'])->default('belum_selesai');
    $table->timestamps();
    $table->foreign('creator_id')->references('id')->on('employees')->onDelete('cascade');
    $table->foreign('penerima_id')->references('id')->on('employees')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
