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
        Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('image')->nullable(); // Untuk foto mobil
        $table->string('brand');
        $table->string('model');
        $table->integer('capacity'); // Kapasitas (penumpang)
        $table->string('transmission'); // Manual/Otomatis
        $table->string('fuel_type'); // Bensin/Diesel/Listrik
        $table->decimal('price', 12, 2);
        $table->text('description');
        $table->string('provider_name'); // Nama pemilik/penyedia
        $table->string('provider_contact'); // Kontak penyedia
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
