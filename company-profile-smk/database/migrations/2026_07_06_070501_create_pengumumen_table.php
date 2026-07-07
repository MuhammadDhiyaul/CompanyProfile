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
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // Judul Pengumuman
            $table->text('content'); // Isi Pengumuman
            $table->string('attachment')->nullable(); // Untuk file lampiran (PDF, Surat, dll)
            $table->boolean('is_active')->default(true); // Status tayang

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};
