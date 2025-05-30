<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_game_to_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $game = Game::factory()->create();

        $response = $this->post(route('cart.add', $game));

        $response->assertRedirect()
            ->assertSessionHas('success', 'Игра добавлена в корзину');

        $this->assertDatabaseHas('cart_items', [
            'user_id' => $user->id,
            'game_id' => $game->id
        ]);
    }

    public function test_view_cart_with_items()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $games = Game::factory()->count(3)->create();
        foreach ($games as $game) {
            $user->cartItems()->create(['game_id' => $game->id]);
        }

        $response = $this->get(route('cart.index'));

        $response->assertOk();

        foreach ($games as $game) {
            $response->assertSee($game->title);
        }

        $total = $games->sum('price');
        $response->assertSee($total);
    }

    public function test_remove_game_from_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $game = Game::factory()->create();
        $cartItem = $user->cartItems()->create(['game_id' => $game->id]);

        $response = $this->delete(route('cart.remove', $cartItem));

        $response->assertRedirect()
            ->assertSessionHas('success', 'Игра удалена из корзины');

        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id
        ]);
    }
}
