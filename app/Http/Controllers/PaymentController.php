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

        $carId = $request->input('car_id');
        $productId = $request->input('product_id');

        if (!$carId && $productId) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                // Find matching car by brand (since sync uses product name as car brand)
                $car = \App\Models\Car::where('brand', $product->name)->first();
                if ($car) {
                    $carId = $car->id;
                }
            }
        }

        if (!$carId) {
            return redirect('/product')->with('warning', 'Mobil belum tersedia untuk disewa. Hubungi admin.');
        }

        $car = Car::findOrFail($carId);

        return view('payment.index', [
            'car' => $car,
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
            'email' => ['nullable', 'email', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'ktp_file' => ['nullable', 'image', 'max:2048'],
            'sim_file' => ['nullable', 'image', 'max:2048'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'pickup_location' => ['nullable', 'string', 'max:255'],
            'pickup_method' => ['nullable', 'string', 'max:255'],
            'return_method' => ['nullable', 'string', 'max:255'],
            'source_info' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['required', 'in:transfer,e_wallet,cash'],
        ]);

        $car = Car::findOrFail($validated['car_id']);
        
        // Calculate duration from start and end dates if end_date is provided
        $duration = 1;
        if (!empty($validated['end_date'])) {
            $start = \Carbon\Carbon::parse($validated['start_date']);
            $end = \Carbon\Carbon::parse($validated['end_date']);
            $duration = $start->diffInDays($end) ?: 1;
        }
        
        $totalPrice = $car->price * $duration;

        // Handle File Uploads
        $ktpPath = null;
        if ($request->hasFile('ktp_file')) {
            $ktpPath = $request->file('ktp_file')->store('bookings/ktp', 'public');
        }

        $simPath = null;
        if ($request->hasFile('sim_file')) {
            $simPath = $request->file('sim_file')->store('bookings/sim', 'public');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'car_id' => $validated['car_id'],
            'customer_name' => $validated['customer_name'],
            'customer_contact' => $validated['customer_contact'],
            'email' => $validated['email'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'ktp_file' => $ktpPath,
            'sim_file' => $simPath,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'duration' => $duration,
            'total_price' => $totalPrice,
            'pickup_location' => $validated['pickup_location'] ?? null,
            'pickup_method' => $validated['pickup_method'] ?? null,
            'return_method' => $validated['return_method'] ?? null,
            'source_info' => $validated['source_info'] ?? null,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('user.rental-history')
            ->with('success', 'Booking Anda berhasil dibuat. Silakan lanjutkan pembayaran sesuai pilihan metode dan tunggu konfirmasi dari admin.');
    }
}
