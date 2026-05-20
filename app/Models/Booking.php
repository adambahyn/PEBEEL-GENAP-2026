<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'customer_name',
        'customer_contact',
        'start_date',
        'end_date',
        'total_price',
        'payment_method',
        'status',
        'pickup_location',
        'pickup_method',
        'return_method',
        'source_info',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    // ====================================================
    // FUNGSI OTOMATISASI STATUS MOBIL (is_booked)
    // ====================================================
    protected static function booted()
    {
        // Berjalan setiap kali data booking dibuat atau diedit/di-save
        static::saved(function ($booking) {
            self::updateProductStatus($booking->product);
        });

        // Berjalan jika data booking dihapus
        static::deleted(function ($booking) {
            self::updateProductStatus($booking->product);
        });
    }

    // Fungsi pembantu untuk mengecek status secara real-time
    private static function updateProductStatus($product)
    {
        if ($product) {
            // Cek apakah produk ini punya booking berstatus 'confirmed' 
            // yang mana tanggal hari ini (now) berada di antara start_date dan end_date
            $isCurrentlyBooked = $product->bookings()
                ->where('status', 'confirmed')
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->exists();

            // Update tabel products sesuai hasil pengecekan di atas
            // Jika ada = true (1), Jika tidak ada / sudah lewat = false (0)
            $product->update([
                'is_booked' => $isCurrentlyBooked
            ]);
        }
    }

    // ====================================================
    // RELASI
    // ====================================================
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}