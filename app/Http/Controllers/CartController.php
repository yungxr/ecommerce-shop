<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('game')->get();
        $total = $cartItems->sum(fn($item) => $item->game->price);
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Game $game)
    {
        auth()->user()->cartItems()->firstOrCreate(['game_id' => $game->id]);
        return back()->with('success', 'Игра добавлена в корзину');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return back()->with('success', 'Игра удалена из корзины');
    }
}
