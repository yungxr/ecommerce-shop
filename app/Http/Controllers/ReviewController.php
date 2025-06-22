<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Game;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Показ формы для отзыва
    public function create(Game $game)
    {
        return view('reviews.create', compact('game'));
    }

    // Сохранение отзыва
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'comment' => 'nullable|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'game_id' => $game->id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('games.show', $game)->with('success', 'Отзыв добавлен!');
    }

    // Удаление отзыва
    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Отзыв удалён!');
    }
}