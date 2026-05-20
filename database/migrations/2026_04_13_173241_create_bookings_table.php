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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // 1. Menyambungkan ke tabel products (Sebelumnya car_id mencari tabel cars)
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            
            // 2. Menyambungkan ke tabel users (Sintaksis disamakan menggunakan cascadeOnDelete)
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->date('start_date');
            $table->date('end_date'); // Menyimpan tanggal selesai sewa
            $table->decimal('total_price', 12, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->string('pickup_location')->nullable();
            $table->string('pickup_method')->nullable();
            $table->string('return_method')->nullable();
            $table->string('source_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};