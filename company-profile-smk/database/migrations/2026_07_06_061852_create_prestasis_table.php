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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // Contoh: Juara 1 Lomba Web Design
            $table->string('student_name'); // Nama Siswa atau Tim
            $table->string('level')->nullable(); // Tingkat: Kota, Provinsi, Nasional
            $table->date('date')->nullable(); // Tanggal atau waktu lomba
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Foto piala, piagam, atau siswa

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
