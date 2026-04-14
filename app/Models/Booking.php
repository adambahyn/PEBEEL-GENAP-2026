<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'car_id',
        'customer_name',
        'customer_contact',
        'start_date',
        'duration',
        'total_price',
        'payment_method',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
