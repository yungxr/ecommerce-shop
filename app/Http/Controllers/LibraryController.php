<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class LibraryController extends Controller
{
    public function index()
    {
        $games = auth()->user()->libraryItems()->with('game')->get()->pluck('game');
        return view('library.index', compact('games'));
    }

    public function show(Game $game)
    {
        if (!auth()->user()->libraryGames()->where('game_id', $game->id)->exists()) {
            abort(403);
        }

        $screenshots = json_decode($game->screenshots, true) ?? [];

        return view('library.show', [
            'game' => $game,
            'screenshots' => $screenshots,
            'purchased_at' => auth()->user()->libraryItems()
                ->where('game_id', $game->id)
                ->first()
                ->created_at
        ]);

        if (!auth()->user()->libraryGames()->where('game_id', $game->id)->exists()) {
            abort(403, 'Эта игра не находится в вашей библиотеке');
        }

        return view('library.game', [
            'game' => $game,
            'purchased_at' => auth()->user()->libraryItems()
                ->where('game_id', $game->id)
                ->first()
                ->created_at
        ]);
    }
}
