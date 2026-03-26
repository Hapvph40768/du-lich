<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_name',
        'customer_phone'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}