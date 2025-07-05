<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with(['game' => function($query) {
            $query->with(['discounts' => function($q) {
                $q->where('is_active', true)
                  ->where('start_date', '<=', now())
                  ->where('end_date', '>=', now());
            }]);
        }])->get();

        $total = $cartItems->sum(function ($item) {
            return $item->game->hasActiveDiscount()
                ? $item->game->discounted_price
                : $item->game->price;
        });

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