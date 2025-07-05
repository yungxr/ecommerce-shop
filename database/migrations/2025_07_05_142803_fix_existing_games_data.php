<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Game;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Game::chunk(100, function ($games) {
            foreach ($games as $game) {
                // Исправляем screenshots
                if (!is_array($game->screenshots)) {
                    $game->screenshots = json_decode($game->screenshots ?: '[]', true) ?? [];
                }

                // Исправляем system_requirements
                if (!is_array($game->system_requirements)) {
                    $game->system_requirements = json_decode($game->system_requirements ?: '{}', true) ?? [
                        'minimum' => [
                            'os' => 'Не указано',
                            'processor' => 'Не указано',
                            'memory' => 'Не указано',
                            'graphics' => 'Не указано',
                            'storage' => 'Не указано'
                        ],
                        'recommended' => [
                            'os' => 'Не указано',
                            'processor' => 'Не указано',
                            'memory' => 'Не указано',
                            'graphics' => 'Не указано',
                            'storage' => 'Не указано'
                        ]
                    ];
                }

                $game->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
