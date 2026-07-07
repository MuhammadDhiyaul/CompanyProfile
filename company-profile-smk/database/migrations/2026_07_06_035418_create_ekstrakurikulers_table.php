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
        Schema::create('ekstrakurikulers', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Contoh: Pramuka, Paskibra, Futsal
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Foto atau Logo Ekskul
        
            // Relasi ke tabel teachers (Guru Pembina)
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikulers');
    }
};
