<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product; // Perbaikan: Import model Product
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

        // Mengambil product_id langsung dari request
        $productId = $request->input('product_id');

        if (!$productId) {
            return redirect('/product')->with('warning', 'Mobil belum dipilih untuk disewa.');
        }

        // Mencari data berdasarkan Product
        $product = Product::findOrFail($productId);

        return view('payment.index', [
            'product' => $product, // Mengirim variabel product ke view
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')
                ->with('warning', 'Anda wajib login terlebih dahulu.');
        }

        // Perbaikan Validasi: Menggunakan exists:products,id bukan cars
        $validated = $request->validate([
            'product_id'       => ['required', 'exists:products,id'],
            'customer_name'    => ['required', 'string', 'max:255'],
            'customer_contact' => ['required', 'string', 'max:20'],
            'email'            => ['nullable', 'email'],
            'alamat'           => ['nullable', 'string'],
            'ktp_file'         => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'sim_file'         => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'start_date'       => ['required', 'date', 'after_or_equal:today'],
            'end_date'         => ['required', 'date', 'after:start_date'],
            'pickup_location'  => ['nullable', 'string'],
            'pickup_method'    => ['nullable', 'string'],
            'return_method'    => ['nullable', 'string'],
            'source_info'      => ['nullable', 'string'],
            'payment_method'   => ['required', 'string'],
        ]);

        // Hitung durasi dan total harga berdasarkan data Product
        $product = Product::findOrFail($validated['product_id']);
        
        $startDate = new \DateTime($validated['start_date']);
        $endDate = new \DateTime($validated['end_date']);
        $duration = $startDate->diff($endDate)->days;
        
        if ($duration <= 0) {
            $duration = 1; // Minimal 1 hari sewa
        }

        $totalPrice = $duration * $product->price;

        // Upload file KTP & SIM jika ada
        $ktpPath = null;
        if ($request->hasFile('ktp_file')) {
            $ktpPath = $request->file('ktp_file')->store('bookings/ktp', 'public');
        }

        $simPath = null;
        if ($request->hasFile('sim_file')) {
            $simPath = $request->file('sim_file')->store('bookings/sim', 'public');
        }

        // Menyimpan data ke tabel bookings
        Booking::create([
            'user_id'          => auth()->id(),
            'product_id'       => $validated['product_id'], // Menggunakan product_id sesuai migrasi baru
            'customer_name'    => $validated['customer_name'],
            'customer_contact' => $validated['customer_contact'],
            'email'            => $validated['email'] ?? null,
            'alamat'           => $validated['alamat'] ?? null,
            'ktp_file'         => $ktpPath,
            'sim_file'         => $simPath,
            'start_date'       => $validated['start_date'],
            'end_date'         => $validated['end_date'],
            'total_price'      => $totalPrice,
            'pickup_location'  => $validated['pickup_location'] ?? null,
            'pickup_method'    => $validated['pickup_method'] ?? null,
            'return_method'    => $validated['return_method'] ?? null,
            'source_info'      => $validated['source_info'] ?? null,
            'payment_method'   => $validated['payment_method'],
            'status'           => 'pending',
        ]);

        return redirect()->route('user.rental-history')
            ->with('success', 'Booking berhasil dibuat! Silahkan tunggu konfirmasi admin.');
    }
}