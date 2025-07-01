<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ModeratorUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'moderator',
            'username' => 'Moderator', 
            'email' => 'moderator@gamestore.com',
            'password' => Hash::make('moderator123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'balance' => 0,
            'avatar' => 'default-avatar.png'
        ]);
    }
}