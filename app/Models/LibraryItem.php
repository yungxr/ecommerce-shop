<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryItem extends Model
{
    protected $fillable = ['user_id', 'game_id', 'purchased_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}