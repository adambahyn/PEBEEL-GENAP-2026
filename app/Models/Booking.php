<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'customer_name',
        'customer_contact',
        'start_date',
        'duration',
        'total_price',
        'payment_method',
        'status',
        'email',
        'alamat',
        'ktp_file',
        'sim_file',
        'end_date',
        'pickup_location',
        'pickup_method',
        'return_method',
        'source_info',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
