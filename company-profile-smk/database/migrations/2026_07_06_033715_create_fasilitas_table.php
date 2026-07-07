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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Contoh: Laboratorium RPL, Lapangan Basket
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Foto ruangan/fasilitas
            $table->string('condition')->nullable(); // Contoh: Baik, Sedang Direnovasi
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
