<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'category_id',
        'location_id',
        'name',
        'description',
        'price',
        'duration_days',
        'duration_nights',
        'max_people',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function schedules()
    {
        return $this->hasMany(TourSchedule::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}