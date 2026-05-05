<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Car;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('is_active', 1);

        // FILTER HARGA
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // FILTER TIPE
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // FILTER LOKASI
        if ($request->location) {
            $query->where('location', $request->location);
        }

        // SORTING
        if ($request->sort == 'cheapest') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'expensive') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(8);

        return view('product.index', compact('products'));
    }

    public function syncToCars()
    {
        $products = Product::where('is_active', 1)->get();

        foreach ($products as $product) {
            Car::updateOrCreate(
                [
                    'brand' => $product->name,
                    'model' => $product->type,
                ],
                [
                    'image' => $product->image,
                    'capacity' => $product->type === 'MPV' ? 7 : 5,
                    'transmission' => 'Automatic',
                    'fuel_type' => 'Bensin',
                    'price' => $product->price,
                    'description' => $product->description,
                    'provider_name' => 'Adam Rental',
                    'provider_contact' => 'admin@pbl.com',
                    'stock' => $product->stock,
                ]
            );
        }

        return redirect()->route('payment.index')
            ->with('success', 'Sinkronisasi dari product ke cars berhasil. Silakan reload halaman payment.');
    }
}