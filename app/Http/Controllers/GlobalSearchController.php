<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('q');

        // 1. Cari Mobil berdasarkan nama atau spesifikasi
        $cars = Car::where('brand', 'ILIKE', "%{$keyword}%")
                    ->orWhere('model', 'ILIKE', "%{$keyword}%")
                    ->orWhere('capacity', 'ILIKE', "%{$keyword}%")
                    ->orWhere('transmission', 'ILIKE', "%{$keyword}%")
                    ->orWhere('fuel_type', 'ILIKE', "%{$keyword}%")
                    ->orWhere('price', 'ILIKE', "%{$keyword}%")
                    ->orWhere('description', 'ILIKE', "%{$keyword}%")
                    ->orWhere('provider_name', 'ILIKE', "%{$keyword}%")
                    ->orWhere('provider_contact', 'ILIKE', "%{$keyword}%")
                    ->get();

        // 2. Cari Produk terkait
        $products = Product::where('name', 'ILIKE', "%{$keyword}%")
        ->orWhere('sku', 'ILIKE', "%{$keyword}%")
        ->orWhere('description', 'ILIKE', "%{$keyword}%")
        ->orWhere('price', 'ILIKE', "%{$keyword}%")
        ->orWhere('type', 'ILIKE', "%{$keyword}%")
        ->orWhere('location', 'ILIKE', "%{$keyword}%")
        ->get();

        // (Opsional) 3. Cek apakah keyword merujuk ke fungsi website
        $helpTopics = [];
        if (stripos($keyword, 'cara booking') !== false) {
            $helpTopics[] = "Untuk melakukan booking, pilih mobil lalu klik tombol 'Pesan Sekarang'.";
        }

        return view('search.results', compact('cars', 'products', 'keyword', 'helpTopics'));
    }
}