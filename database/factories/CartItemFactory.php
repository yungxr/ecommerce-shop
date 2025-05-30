<?php
namespace Database\Factories;

use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'game_id' => Game::factory(),
        ];
    }
}