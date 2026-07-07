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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();

            $table->string('image'); // Gambar utama slider (Wajib)
            $table->string('title')->nullable(); // Teks Judul Besar (Opsional)
            $table->string('subtitle')->nullable(); // Teks Subjudul kecil (Opsional)
            $table->string('button_text')->nullable(); // Teks tombol, misal: "Daftar Sekarang"
            $table->string('button_link')->nullable(); // Link tujuan jika tombol diklik
            $table->boolean('is_active')->default(true); // Status tayang
            $table->integer('sort_order')->default(0); // Urutan urutan slide

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
