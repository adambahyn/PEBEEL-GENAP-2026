<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Booking;
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
            'name' => 'Admin',
            'email' => 'admin@pbl.com',
            'password' => Hash::make('123'),
            'role' => 'admin', // Pastikan kolom role sudah ada di migration
        ]);

        // 2. Membuat Akun User (Pelanggan)
        User::create([
            'name' => 'Pelanggan Tes',
            'email' => 'user@pbl.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);

        $products = [
            [
                'name' => 'Toyota Avanza',
                'sku' => 'AVANZA_01',
                'type' => 'MPV',
                'brand' => 'Toyota',
                'model' => 'Avanza 1.3',
                'capacity' => 7,
                'transmission' => 'Automatic',
                'fuel_type' => 'Bensin',
                'location' => 'Malang',
                'description' => 'Mobil keluarga yang irit dan nyaman.',
                'price' => 500000,
                'stock' => 5,
                'is_booked' => false,
                'is_featured' => true,
            ],
            [
                'name' => 'Honda CR-V',
                'sku' => 'CRV_01',
                'type' => 'SUV',
                'brand' => 'Honda',
                'model' => 'CR-V Turbo',
                'capacity' => 5,
                'transmission' => 'Automatic',
                'fuel_type' => 'Bensin',
                'location' => 'Malang',
                'description' => 'SUV tangguh untuk segala medan.',
                'price' => 850000,
                'stock' => 3,
                'is_booked' => false,
                'is_featured' => false,
            ]
        ];

        foreach ($products as $p) {
            $product = Product::updateOrCreate(['sku' => $p['sku']], $p);

            // 3. Data Seed Booking (Relasi ke Product yang baru dibuat)
            Booking::create([
                'product_id' => $product->id,
                'customer_name' => 'Budi Santoso',
                'customer_contact' => '08123456789',
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(3),
                'total_price' => $product->price * 2,
                'payment_method' => 'transfer',
                'status' => 'pending',
                'pickup_location' => 'Bandara Abdul Rachman Saleh',
            ]);
        }
    }
}