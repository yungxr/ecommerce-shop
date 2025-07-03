<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class ShopController extends Controller
{
    public function index()
    {
        $games = Game::with(['discounts' => function ($query) {
            $query->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
        }])
            ->when(request('genre'), fn($q, $genre) => $q->where('genre', $genre))
            ->when(request('search'), fn($q, $search) => $q->where('title', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12);

        $genres = Game::distinct()->pluck('genre');
        return view('shop.index', compact('games', 'genres'));
    }

    public function show(Game $game)
    {
        $game->load(['discounts' => function ($query) {
            $query->active();
        }]);

        return view('shop.show', compact('game'));
    }
}
