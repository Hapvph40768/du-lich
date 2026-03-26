<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // user đặt nhiều booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // user viết nhiều review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // user tạo ticket hỗ trợ
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    // user viết blog
    public function blogs()
    {
        return $this->hasMany(Blog::class,'author_id');
    }
}