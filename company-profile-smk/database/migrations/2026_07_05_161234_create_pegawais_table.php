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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('nip')->nullable(); // NIP atau NIK
            $table->string('position'); // Contoh: Kepala Tata Usaha, Satpam
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('image')->nullable(); // Foto profil
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
