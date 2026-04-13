<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Akun Admin
        User::create([
            'name' => 'Admin PBL',
            'email' => 'admin@pbl.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Pastikan kolom role sudah ada di migration
        ]);

        // 2. Membuat Akun User (Pelanggan)
        User::create([
            'name' => 'Pelanggan Tes',
            'email' => 'user@pbl.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}