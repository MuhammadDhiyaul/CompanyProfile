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
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            
             // Identitas
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('npsn')->nullable();
            $table->string('nss')->nullable();
            $table->string('status')->nullable();
            $table->string('accreditation')->nullable();
            $table->string('principal')->nullable();

            // Kontak
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();

            // Alamat
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('google_maps')->nullable();

            // Profil
            $table->longText('history')->nullable();
            $table->longText('vision')->nullable();
            $table->longText('mission')->nullable();

            // Media
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('hero_image')->nullable();

            // Sosial Media
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
