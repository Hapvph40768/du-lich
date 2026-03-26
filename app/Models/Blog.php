<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }
}