<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        $discountedGames = Game::whereHas('discounts', function ($query) {
            $query->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
        })
            ->with(['discounts' => function ($query) {
                $query->where('is_active', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            }])
            ->take(6) // Ограничиваем количество игр
            ->get();

        return view('home', compact('discountedGames'));
    }
}
