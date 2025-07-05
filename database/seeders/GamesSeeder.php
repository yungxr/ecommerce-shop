<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'title' => 'Cyberpunk 2099',
                'description' => 'Продолжение культовой игры в жанре киберпанк с открытым миром.',
                'price' => 2999.00,
                'genre' => 'RPG',
                'image' => 'images/games/cyberpunk.jpg',
                'screenshots' => json_encode([
                    'images/games/screenshots/cyberpunk1.jpg',
                    'images/games/screenshots/cyberpunk2.jpg'
                ]),
                'release_date' => '2024-12-10',
                'developer' => 'CD Projekt Red',
                'system_requirements' => json_encode([
                    'minimum' => [
                        'os' => 'Windows 10 64-bit',
                        'processor' => 'Intel Core i5-3570K or AMD FX-8310',
                        'memory' => '8 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 780 or AMD Radeon RX 470',
                        'storage' => '70 GB available space'
                    ],
                    'recommended' => [
                        'os' => 'Windows 10/11 64-bit',
                        'processor' => 'Intel Core i7-4790 or AMD Ryzen 3 3200G',
                        'memory' => '16 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 1060 or AMD Radeon RX 590',
                        'storage' => '70 GB SSD'
                    ]
                ])
            ],
            [
                'title' => 'Grand Theft Auto VI',
                'description' => 'Новая часть легендарной серии игр про криминальный мир.',
                'price' => 3499.00,
                'genre' => 'Экшен',
                'image' => 'images/games/gta6.jpg',
                'screenshots' => json_encode([
                    'images/games/screenshots/gta1.jpg',
                    'images/games/screenshots/gta2.jpg'
                ]),
                'release_date' => '2025-03-15',
                'developer' => 'Rockstar Games',
                'system_requirements' => json_encode([
                    'minimum' => [
                        'os' => 'Windows 10 64-bit',
                        'processor' => 'Intel Core i5-3570K or AMD FX-8310',
                        'memory' => '8 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 780 or AMD Radeon RX 470',
                        'storage' => '70 GB available space'
                    ],
                    'recommended' => [
                        'os' => 'Windows 10/11 64-bit',
                        'processor' => 'Intel Core i7-4790 or AMD Ryzen 3 3200G',
                        'memory' => '16 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 1060 or AMD Radeon RX 590',
                        'storage' => '70 GB SSD'
                    ]
                ])
            ],
            [
                'title' => 'The Witcher 4',
                'description' => 'Продолжение саги о ведьмаке с новой системой боя и открытым миром.',
                'price' => 3299.00,
                'genre' => 'RPG',
                'image' => 'images/games/witcher4.jpg',
                'screenshots' => json_encode([
                    'images/games/screenshots/witcher1.jpg',
                    'images/games/screenshots/witcher2.jpg'
                ]),
                'release_date' => '2025-09-20',
                'developer' => 'CD Projekt Red',
                'system_requirements' => json_encode([
                    'minimum' => [
                        'os' => 'Windows 10 64-bit',
                        'processor' => 'Intel Core i5-3570K or AMD FX-8310',
                        'memory' => '8 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 780 or AMD Radeon RX 470',
                        'storage' => '70 GB available space'
                    ],
                    'recommended' => [
                        'os' => 'Windows 10/11 64-bit',
                        'processor' => 'Intel Core i7-4790 or AMD Ryzen 3 3200G',
                        'memory' => '16 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 1060 or AMD Radeon RX 590',
                        'storage' => '70 GB SSD'
                    ]
                ])
            ],
            [
                'title' => 'Hollow Knight: Silksong',
                'description' => 'Долгожданное продолжение культового метроидвании про приключения Хорнета.',
                'price' => 1999.00,
                'genre' => 'Метроидвания',
                'image' => 'images/games/silksong.jpg',
                'screenshots' => json_encode([
                    'images/games/screenshots/silksong1.jpg',
                    'images/games/screenshots/silksong2.jpg'
                ]),
                'release_date' => '2024-06-15',
                'developer' => 'Team Cherry',
                'system_requirements' => json_encode([
                    'minimum' => [
                        'os' => 'Windows 10 64-bit',
                        'processor' => 'Intel Core i5-3570K or AMD FX-8310',
                        'memory' => '8 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 780 or AMD Radeon RX 470',
                        'storage' => '70 GB available space'
                    ],
                    'recommended' => [
                        'os' => 'Windows 10/11 64-bit',
                        'processor' => 'Intel Core i7-4790 or AMD Ryzen 3 3200G',
                        'memory' => '16 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 1060 or AMD Radeon RX 590',
                        'storage' => '70 GB SSD'
                    ]
                ])
            ],
            [
                'title' => 'The Blood of Dawnwalker',
                'description' => 'Новая мрачная RPG в стиле "тёмного фэнтези" с глубоким сюжетом.',
                'price' => 2799.00,
                'genre' => 'RPG',
                'image' => 'images/games/dawnwalker.jpg',
                'screenshots' => json_encode([
                    'images/games/screenshots/dawnwalker1.jpg',
                    'images/games/screenshots/dawnwalker2.jpg'
                ]),
                'release_date' => '2025-02-28',
                'developer' => 'Nocturnal Studios',
                'system_requirements' => json_encode([
                    'minimum' => [
                        'os' => 'Windows 10 64-bit',
                        'processor' => 'Intel Core i5-3570K or AMD FX-8310',
                        'memory' => '8 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 780 or AMD Radeon RX 470',
                        'storage' => '70 GB available space'
                    ],
                    'recommended' => [
                        'os' => 'Windows 10/11 64-bit',
                        'processor' => 'Intel Core i7-4790 or AMD Ryzen 3 3200G',
                        'memory' => '16 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 1060 or AMD Radeon RX 590',
                        'storage' => '70 GB SSD'
                    ]
                ])
            ],
            [
                'title' => 'Assassin\'s Creed 4: Black Flag Remake',
                'description' => 'Полностью переработанная версия культовой игры о пиратах с улучшенной графикой.',
                'price' => 2499.00,
                'genre' => 'Приключения',
                'image' => 'images/games/ac4_remake.jpg',
                'screenshots' => json_encode([
                    'images/games/screenshots/ac4_1.jpg',
                    'images/games/screenshots/ac4_2.jpg'
                ]),
                'release_date' => '2024-11-12',
                'developer' => 'Ubisoft Montreal',
                'system_requirements' => json_encode([
                    'minimum' => [
                        'os' => 'Windows 10 64-bit',
                        'processor' => 'Intel Core i5-3570K or AMD FX-8310',
                        'memory' => '8 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 780 or AMD Radeon RX 470',
                        'storage' => '70 GB available space'
                    ],
                    'recommended' => [
                        'os' => 'Windows 10/11 64-bit',
                        'processor' => 'Intel Core i7-4790 or AMD Ryzen 3 3200G',
                        'memory' => '16 GB RAM',
                        'graphics' => 'NVIDIA GeForce GTX 1060 or AMD Radeon RX 590',
                        'storage' => '70 GB SSD'
                    ]
                ])
            ]
        ];

        foreach ($games as $gameData) {
            Game::create($gameData);
        }
    }
}