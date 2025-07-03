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

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $activeDiscount = $this->discounts()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($activeDiscount) {
            return $this->price * (1 - $activeDiscount->percent / 100);
        }

        return $this->price;
    }

    public function hasActiveDiscount()
    {
        return $this->discounts()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();
    }
}