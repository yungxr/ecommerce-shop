<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        \App\Models\Game::chunk(100, function ($games) {
            foreach ($games as $game) {
                // Исправляем screenshots
                if (is_string($game->screenshots)) {
                    try {
                        $decoded = json_decode($game->screenshots, true);
                        $game->screenshots = is_array($decoded) ? $decoded : [];
                    } catch (\Exception $e) {
                        $game->screenshots = [];
                    }
                }

                // Исправляем system_requirements
                if (is_string($game->system_requirements)) {
                    try {
                        $decoded = json_decode($game->system_requirements, true);
                        if (!is_array($decoded)) {
                            throw new \Exception('Invalid JSON');
                        }
                    } catch (\Exception $e) {
                        $decoded = [
                            'minimum' => [
                                'os' => '',
                                'processor' => '',
                                'memory' => '',
                                'graphics' => '',
                                'storage' => ''
                            ],
                            'recommended' => [
                                'os' => '',
                                'processor' => '',
                                'memory' => '',
                                'graphics' => '',
                                'storage' => ''
                            ]
                        ];
                    }
                    $game->system_requirements = $decoded;
                }

                $game->save();
            }
        });
    }

    protected function getDefaultRequirements(): array
    {
        return [
            'os' => '',
            'processor' => '',
            'memory' => '',
            'graphics' => '',
            'storage' => ''
        ];
    }

    public function down()
    {
        // Откат не требуется, так как это миграция данных
    }
};
