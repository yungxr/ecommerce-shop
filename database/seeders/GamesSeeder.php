<?php

namespace Database\Seeders;

use App\Models\Game; // Добавьте этот импорт
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Game::create([
            'title' => 'Cyberpunk 2099',
            'description' => 'Продолжение культовой игры в жанре киберпанк с открытым миром.',
            'price' => 2999.00,
            'genre' => 'RPG',
            'image' => 'cyberpunk.jpg',
            'screenshots' => json_encode(['cyberpunk1.jpg', 'cyberpunk2.jpg']),
            'release_date' => '2024-12-10',
            'developer' => 'CD Projekt Red'
        ]);

        Game::create([
            'title' => 'Grand Theft Auto VI',
            'description' => 'Новая часть легендарной серии игр про криминальный мир.',
            'price' => 3499.00,
            'genre' => 'Экшен',
            'image' => 'gta6.jpg',
            'screenshots' => json_encode(['gta1.jpg', 'gta2.jpg']),
            'release_date' => '2025-03-15',
            'developer' => 'Rockstar Games'
        ]);

        Game::create([
            'title' => 'The Witcher 4',
            'description' => 'Продолжение саги о ведьмаке с новой системой боя и открытым миром.',
            'price' => 3299.00,
            'genre' => 'RPG',
            'image' => 'witcher4.jpg',
            'screenshots' => json_encode(['witcher1.jpg', 'witcher2.jpg']),
            'release_date' => '2025-09-20',
            'developer' => 'CD Projekt Red'
        ]);

        Game::create([
            'title' => 'Hollow Knight: Silksong',
            'description' => 'Долгожданное продолжение культового метроидвании про приключения Хорнета.',
            'price' => 1999.00,
            'genre' => 'Метроидвания',
            'image' => 'silksong.jpg',
            'screenshots' => json_encode(['silksong1.jpg', 'silksong2.jpg']),
            'release_date' => '2024-06-15',
            'developer' => 'Team Cherry'
        ]);

        Game::create([
            'title' => 'The Blood of Dawnwalker',
            'description' => 'Новая мрачная RPG в стиле "тёмного фэнтези" с глубоким сюжетом.',
            'price' => 2799.00,
            'genre' => 'RPG',
            'image' => 'dawnwalker.jpg',
            'screenshots' => json_encode(['dawnwalker1.jpg', 'dawnwalker2.jpg']),
            'release_date' => '2025-02-28',
            'developer' => 'Nocturnal Studios'
        ]);

        Game::create([
            'title' => 'Assassin’s Creed 4: Black Flag Remake',
            'description' => 'Полностью переработанная версия культовой игры о пиратах с улучшенной графикой.',
            'price' => 2499.00,
            'genre' => 'Приключения',
            'image' => 'ac4_remake.jpg',
            'screenshots' => json_encode(['ac4_1.jpg', 'ac4_2.jpg']),
            'release_date' => '2024-11-12',
            'developer' => 'Ubisoft Montreal'
        ]);
    }
}
