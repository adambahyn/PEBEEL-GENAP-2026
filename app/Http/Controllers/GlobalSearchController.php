<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('q');
        $operator = config('database.default') === 'pgsql' ? 'ILIKE' : 'LIKE';
        $columns = [
            'name',
            'sku',
            'brand',
            'model',
            'capacity',
            'transmission',
            'fuel_type',
            'description',
            'price',
            'type',
            'location',
        ];

        // Cari mobil dari tabel products.
        $products = Product::query()
            ->where(function ($query) use ($columns, $keyword, $operator) {
                foreach ($columns as $column) {
                    $query->orWhere($column, $operator, "%{$keyword}%");
                }
            })
            ->get();

        // (Opsional) 3. Cek apakah keyword merujuk ke fungsi website
        $helpTopics = [];
        if (stripos($keyword, 'cara booking') !== false) {
            $helpTopics[] = "Untuk melakukan booking, pilih mobil lalu klik tombol 'Pesan Sekarang'.";
        }

        return view('search.results', compact('products', 'keyword', 'helpTopics'));
    }
}
