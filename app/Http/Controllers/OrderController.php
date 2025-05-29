<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Game;
use App\Models\LibraryItem;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('game')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        // Рассчитываем общую сумму
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->game->price;
        });

        // Проверяем баланс
        if ($user->balance < $totalPrice) {
            return redirect()->route('cart.index')->with('error', 'Недостаточно средств на балансе!');
        }

        // Списываем деньги
        $user->decrement('balance', $totalPrice);

        foreach ($cartItems as $item) {
            // Добавляем игру в библиотеку
            $user->libraryItems()->firstOrCreate(['game_id' => $item->game_id]);

    foreach ($cartItems as $item) {
        // Добавляем игру в библиотеку
        $user->libraryItems()->firstOrCreate(['game_id' => $item->game_id]);

        // Добавляем активность
        Activity::create([
            'user_id' => $user->id,
            'type' => 'purchase',
            'description' => 'Покупка игры: ' . $item->game->title,
            'data' => [
                'game_id' => $item->game_id,
                'price' => $item->game->price
            ]
        ]);

        // Начисляем опыт
        $user->increment('experience', 100);
    }

    // Проверяем уровень
    $expNeeded = $user->level * 200;
    if ($user->experience >= $expNeeded) {
        $user->increment('level');
        Activity::create([
            'user_id' => $user->id,
            'type' => 'level_up',
            'description' => 'Достигнут новый уровень: ' . ($user->level + 1)
        ]);
    }

        // Очищаем корзину
        $user->cartItems()->delete();

        return redirect()->route('library.index')->with('success', 'Покупка успешно оформлена!');
    }
}
}