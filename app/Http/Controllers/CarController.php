<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Product;


class CarController extends Controller
{
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function userShow($product_id)
    {
        $product = Product::find($product_id);
        
        if (!$product) {
            return redirect('/product')->with('error', 'Maaf, produk tidak ditemukan. Hubungi admin untuk informasi lebih lanjut.');
        }

        $car = $product->car;
        
        if (!$car) {
            return redirect('/product')->with('error', 'Maaf, detail mobil belum tersedia. Hubungi admin untuk informasi lebih lanjut.');
        }
        
        return view('cars.user-show', compact('car', 'product'));
    }
}
