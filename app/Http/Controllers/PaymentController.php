<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')
                ->with('warning', 'Anda wajib login terlebih dahulu.');
        }

        $cars = Car::query()->where('stock', '>', 0)->get();

        return view('payment.index', [
            'cars' => $cars,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')
                ->with('warning', 'Anda wajib login terlebih dahulu.');
        }
        $validated = $request->validate([
            'car_id' => ['required', 'exists:cars,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_contact' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'in:transfer,e_wallet,cash'],
        ]);

        $car = Car::findOrFail($validated['car_id']);
        $totalPrice = $car->price * $validated['duration'];

        Booking::create([
            'car_id' => $validated['car_id'],
            'customer_name' => $validated['customer_name'],
            'customer_contact' => $validated['customer_contact'],
            'start_date' => $validated['start_date'],
            'duration' => $validated['duration'],
            'total_price' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('payment.index')
            ->with('success', 'Booking Anda berhasil dibuat. Silakan lanjutkan pembayaran sesuai pilihan metode dan tunggu konfirmasi dari admin.');
    }
}
