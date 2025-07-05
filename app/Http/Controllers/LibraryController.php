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
        // Проверка доступа к игре
        if (!auth()->user()->libraryGames()->where('game_id', $game->id)->exists()) {
            abort(403, 'Эта игра не находится в вашей библиотеке');
        }

        // Получаем дату покупки
        $purchasedAt = auth()->user()->libraryItems()
            ->where('game_id', $game->id)
            ->first()
            ->created_at;

        // Обрабатываем скриншоты
        $screenshots = $game->screenshots;
        if (is_string($screenshots)) {
            try {
                $screenshots = json_decode($screenshots, true) ?? [];
            } catch (\Exception $e) {
                $screenshots = [];
            }
        } elseif (!is_array($screenshots)) {
            $screenshots = [];
        }

        return view('library.show', [
            'game' => $game,
            'screenshots' => $screenshots,
            'purchased_at' => $purchasedAt
        ]);
    }
}