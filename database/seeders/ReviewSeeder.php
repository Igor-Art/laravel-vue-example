<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    private int $number = 50;

    public function run(): void
    {
        Review::factory()
            ->count($this->number)
            ->sequence(...$this->getRelations())
            ->create();
    }

    private function getRelations(): array
    {
        $games = Game::query()->limit(100)->pluck('id');
        $users = User::query()->limit(100)->pluck('id');

        $pairs = collect();

        foreach ($users as $userId) {
            foreach ($games as $gameId) {
                $pairs->push([
                    'game_id' => $gameId,
                    'user_id' => $userId,
                ]);
            }
        }

        return $pairs->random($this->number)->toArray();
    }
}
