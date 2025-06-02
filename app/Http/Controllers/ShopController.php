<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class ShopController extends Controller
{
    public function index()
    {
        $games = Game::query()
            ->when(request('genre'), fn($q, $genre) => $q->where('genre', $genre))
            ->when(request('search'), fn($q, $search) => $q->where('title', 'like', "%{$search}%"))
            ->latest()  // Добавьте сортировку
            ->get();    // Замените paginate(6) на get()

        $genres = Game::distinct()->pluck('genre');

        return view('shop.index', compact('games', 'genres'));
    }

    public function show(Game $game)
    {
        return view('shop.show', compact('game'));
    }
}
