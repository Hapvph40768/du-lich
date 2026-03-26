<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_order_value',
        'max_discount',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'status'
    ];

    // Coupon có thể được dùng trong nhiều booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}