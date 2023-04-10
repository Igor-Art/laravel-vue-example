<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    private array $items = [
        ['title' => 'Terraria'],
        ['title' => 'Valheim'],
        ['title' => 'Dead Cells'],
        ['title' => 'Factorio'],
        ['title' => 'Cuphead'],
        ['title' => 'Deep Rock Galactic'],
        ['title' => '7 Days to Die'],
        ['title' => 'Graveyard Keeper'],
        ['title' => 'Supraland'],
        ['title' => 'Disco Elysium'],
        ['title' => 'Death\'s Door'],
        ['title' => 'Prodeus'],
        ['title' => 'Don\'t Starve Together'],
        ['title' => 'Helldivers'],
        ['title' => 'Black Mesa'],
        ['title' => 'Ape Out'],
        ['title' => 'Forgive Me Father'],
        ['title' => 'Oxygen Not Included'],
        ['title' => 'Levelhead'],
        ['title' => 'Hades'],
        ['title' => 'Beholder 2'],
        ['title' => '7 Billion Humans'],
        ['title' => 'Frostpunk'],
        ['title' => '7th Sector'],
        ['title' => 'Intravenous'],
        ['title' => 'Move or Die'],
        ['title' => 'Mayhem in Single Valley'],
        ['title' => 'Ministry of Broadcast'],
        ['title' => 'Darkwood'],
        ['title' => 'VVVVVV'],
        ['title' => 'while True: learn()'],
        ['title' => 'Katana ZERO'],
        ['title' => 'HAAK'],
        ['title' => 'Fury Unleashed'],
        ['title' => 'Layers of Fear'],
        ['title' => 'Hotline Miami 2: Wrong Number'],
        ['title' => 'Superliminal'],
        ['title' => 'Super Meat Boy'],
        ['title' => 'Invisible, Inc'],
        ['title' => 'FAR: Lone Sails'],
        ['title' => 'LIMBO'],
        ['title' => 'Little Big Workshop'],
        ['title' => 'Visage'],
        ['title' => 'Streets of Rogue'],
        ['title' => 'INSIDE'],
        ['title' => 'Neon Abyss'],
        ['title' => 'Enter the Gungeon'],
        ['title' => '911 Operator'],
        ['title' => 'Shadowrun Returns'],
        ['title' => 'RimWorld'],
        ['title' => 'Daymare: 1998'],
        ['title' => 'Lonely Mountains: Downhill'],
        ['title' => 'The Long Dark'],
        ['title' => 'Patholodic 2'],
        ['title' => 'Little Nightmares'],
        ['title' => 'ANNO: Mutationem'],
        ['title' => 'Hacknet'],
        ['title' => 'Moonlighter'],
        ['title' => 'STALCRAFT'],
        ['title' => 'VOID BASTARDS'],
        ['title' => 'Severed Steel'],
        ['title' => 'Tinykin'],
        ['title' => 'DYSMANTLE'],
    ];

    public function run(): void
    {
        Game::factory()
            ->count(count($this->items))
            ->sequence(...$this->items)
            ->create();
    }
}
