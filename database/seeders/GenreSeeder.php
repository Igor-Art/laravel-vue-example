<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    private array $items = [
        ['title' => 'FPS'],
        ['title' => 'TPS'],
        ['title' => 'Adventure'],
        ['title' => 'Shooter'],
        ['title' => 'Roguelike'],
        ['title' => 'Horror'],
        ['title' => 'Sandbox'],
        ['title' => 'RPG'],
        ['title' => 'Strategy'],
        ['title' => 'Simulator'],
        ['title' => 'Quest'],
        ['title' => 'MMO'],
        ['title' => 'Stealth'],
        ['title' => 'Survival'],
        ['title' => 'Beat Em Up'],
        ['title' => 'Slasher'],
    ];

    public function run(): void
    {
        Genre::factory()
            ->count(count($this->items))
            ->sequence(...$this->items)
            ->create();
    }
}
