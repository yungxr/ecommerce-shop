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
}
