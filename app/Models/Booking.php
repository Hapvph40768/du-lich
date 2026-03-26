<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_id',
        'total_price',
        'status',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(TourSchedule::class);
    }

    public function details()
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}