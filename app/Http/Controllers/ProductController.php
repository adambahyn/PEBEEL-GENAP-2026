<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
}