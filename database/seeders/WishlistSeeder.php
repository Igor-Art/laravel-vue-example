<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->limit(100)->get();
        $games = Game::query()->limit(100)->pluck('id');

        $users->each(fn ($user) => $user->wishlist()->attach($games->random(mt_rand(0, 5))));
    }
}
