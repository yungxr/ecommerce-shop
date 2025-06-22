<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'genre',
        'image',
        'screenshots',
        'release_date',
        'developer'
    ];

    protected $casts = [
        'screenshots' => 'array',
        'release_date' => 'date'
    ];

    public function libraryItems()
    {
        return $this->hasMany(LibraryItem::class);
    }

    // Game.php
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
