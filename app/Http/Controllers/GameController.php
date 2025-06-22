<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function show(Game $game)
    {
        return view('shop.show', [
            'game' => $game,
            'reviews' => $game->reviews()->with('user')->latest()->get()
        ]);
    }
}
