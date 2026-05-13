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
        $games = [
            [
                'name' => 'Memory Matrix',
                'slug' => 'memory-matrix',
                'description' => 'Match pairs of educational cards to improve your focus and memory.',
                'points_reward' => 20,
                'icon' => '🧠',
            ],
            [
                'name' => 'Math Quest',
                'slug' => 'math-quest',
                'description' => 'Solve rapid-fire math problems to sharpen your arithmetic skills.',
                'points_reward' => 25,
                'icon' => '🔢',
            ],
            [
                'name' => 'Logic Link',
                'slug' => 'logic-link',
                'description' => 'Connect logical patterns to solve complex puzzles.',
                'points_reward' => 30,
                'icon' => '🧩',
            ],
        ];

        foreach ($games as $game) {
            Game::updateOrCreate(['slug' => $game['slug']], $game);
        }
    }
}
