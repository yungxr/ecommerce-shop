<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        \App\Models\Game::chunk(100, function ($games) {
            foreach ($games as $game) {
                // Обновляем только если screenshots не является массивом
                if (!is_array($game->screenshots)) {
                    $game->screenshots = $game->screenshots; // Автоматически преобразуется через аксессор
                }

                // Обновляем только если system_requirements не является массивом
                if (!is_array($game->system_requirements)) {
                    $game->system_requirements = $game->system_requirements; // Автоматически преобразуется
                }

                $game->saveQuietly(); // Сохраняем без вызова событий
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
