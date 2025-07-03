<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Request $request, $gameId)
    {
        $wishlistItem = Wishlist::where('user_id', auth()->id())
            ->where('game_id', $gameId)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return back()->with('success', 'Игра удалена из вишлиста');
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'game_id' => $gameId
            ]);
            return back()->with('success', 'Игра добавлена в вишлист');
        }
    }

    public function index()
    {
        $games = auth()->user()->wishlistGames()
            ->with(['discounts' => function ($query) {
                $query->where('is_active', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            }])
            ->get();

        return view('wishlist.index', compact('games'));
    }
}
