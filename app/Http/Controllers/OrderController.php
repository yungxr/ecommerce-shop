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

        // Загружаем игры с активными скидками
        $cartItems = $user->cartItems()->with(['game.discounts' => function ($query) {
            $query->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
        }])->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        // Рассчитываем общую сумму С УЧЕТОМ СКИДОК
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->game->hasActiveDiscount()
                ? $item->game->discounted_price
                : $item->game->price;
        });

        // Проверяем баланс
        if ($user->balance < $totalPrice) {
            return redirect()->route('cart.index')->with('error', 'Недостаточно средств на балансе!');
        }

        // Списываем деньги (уже с учетом скидок)
        $user->decrement('balance', $totalPrice);

        foreach ($cartItems as $item) {
            // Добавляем игру в библиотеку
            $user->libraryItems()->firstOrCreate(['game_id' => $item->game_id]);

            // Добавляем активность (сохраняем цену, по которой купили)
            Activity::create([
                'user_id' => $user->id,
                'type' => 'purchase',
                'description' => 'Покупка игры: ' . $item->game->title,
                'data' => [
                    'game_id' => $item->game_id,
                    'price' => $item->game->hasActiveDiscount()
                        ? $item->game->discounted_price
                        : $item->game->price
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
                'description' => 'Достигнут новый уровень: ' . ($user->level)
            ]);
        }

        // Очищаем корзину
        $user->cartItems()->delete();

        return redirect()->route('library.index')->with('success', 'Покупка успешно оформлена!');
    }
}
