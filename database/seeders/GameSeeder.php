<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manually creating game
        Game::create([
            'title' => 'God of War',
            'description' => 'lorem ipsum',
            'release_date' => '2018-01-01',
            'genre' => 'RPG',
            'user_id' => '1'
        ]);

        Game::create([
            'title' => 'Elden Ring',
            'description' => 'lorem ipsum',
            'release_date' => '2024-05-03',
            'genre' => 'RPG',
            'user_id' => '1'
        ]);

        Game::create([
            'title' => 'Dota 2',
            'description' => 'lorem ipsum',
            'release_date' => '2008-01-01',
            'genre' => 'MOBA',
            'user_id' => '1'
        ]);

        Game::create([
            'title' => 'Dota 2',
            'description' => 'lorem ipsum',
            'release_date' => '2008-01-01',
            'genre' => 'MOBA',
            'user_id' => '2'
        ]);

        Game::create([
            'title' => 'League of Legends',
            'description' => 'lorem ipsum',
            'release_date' => '2009-01-01',
            'genre' => 'MOBA',
            'user_id' => '2'
        ]);

        Game::create([
            'title' => 'Elden Ring',
            'description' => 'lorem ipsum',
            'release_date' => '2024-05-03',
            'genre' => 'RPG',
            'user_id' => '2'
        ]);
    }
}
