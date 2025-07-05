<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'developer',
        'system_requirements'
    ];

    protected $casts = [
        'release_date' => 'date',
        'screenshots' => 'array',
        'system_requirements' => 'array'
    ];

    protected $appends = [
        'discounted_price'
    ];

    // Отношения
    public function libraryItems()
    {
        return $this->hasMany(LibraryItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    // Методы
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getDiscountedPriceAttribute()
    {
        $activeDiscount = $this->discounts()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        return $activeDiscount 
            ? $this->price * (1 - $activeDiscount->percent / 100)
            : $this->price;
    }

    public function hasActiveDiscount()
    {
        return $this->discounts()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();
    }

    // Аксессоры и мутаторы
    public function getScreenshotsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_null($value)) {
            return [];
        }

        try {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function setScreenshotsAttribute($value)
    {
        $this->attributes['screenshots'] = is_array($value) 
            ? json_encode($value) 
            : $value;
    }

    public function getSystemRequirementsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $default = $this->getDefaultSystemRequirements();

        if (is_null($value)) {
            return $default;
        }

        try {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    public function setSystemRequirementsAttribute($value)
    {
        $this->attributes['system_requirements'] = is_array($value)
            ? json_encode($value)
            : $value;
    }

    protected function getDefaultSystemRequirements()
    {
        return [
            'minimum' => [
                'os' => 'Не указано',
                'processor' => 'Не указано',
                'memory' => 'Не указано',
                'graphics' => 'Не указано',
                'storage' => 'Не указано'
            ],
            'recommended' => [
                'os' => 'Не указано',
                'processor' => 'Не указано',
                'memory' => 'Не указано',
                'graphics' => 'Не указано',
                'storage' => 'Не указано'
            ]
        ];
    }
}