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
            'user_id' => '2'
        ]);
    }
}
