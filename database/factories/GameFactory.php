<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\User;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'genre' => $this->faker->word,
            'image' => $this->faker->imageUrl(),
            'screenshots' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
            'release_date' => $this->faker->date(),
            'developer' => $this->faker->company,
        ];
    }
}