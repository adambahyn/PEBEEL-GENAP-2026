<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    protected $fillable = [
    'image', 'brand', 'model', 'capacity',
    'transmission', 'fuel_type', 'price',
    'description', 'provider_name', 'provider_contact'
];
public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
