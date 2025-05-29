<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CartItem;
use App\Models\LibraryItem;
use App\Models\Game;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'balance',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Добавляем отношения

    /**
     * Игры в корзине пользователя
     */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Игры в библиотеке пользователя
     */
    public function libraryItems()
    {
        return $this->hasMany(LibraryItem::class);
    }

    /**
     * Доступ к играм через корзину (отношение многие-ко-многим)
     */
    public function cartGames()
    {
        return $this->belongsToMany(Game::class, 'cart_items')
            ->withTimestamps();
    }

    /**
     * Игры в библиотеке (отношение многие-ко-многим)
     */
    public function libraryGames()
    {
        return $this->belongsToMany(Game::class, 'library_items')
            ->withPivot('purchased_at')
            ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
