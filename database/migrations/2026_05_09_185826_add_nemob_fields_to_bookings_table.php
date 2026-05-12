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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('ktp_file')->nullable();
            $table->string('sim_file')->nullable();
            $table->date('end_date')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('pickup_method')->nullable();
            $table->string('return_method')->nullable();
            $table->string('source_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'email', 'alamat', 'ktp_file', 'sim_file', 
                'end_date', 'pickup_location', 'pickup_method', 
                'return_method', 'source_info'
            ]);
        });
    }
};
