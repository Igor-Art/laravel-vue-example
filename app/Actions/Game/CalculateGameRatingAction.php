<?php

namespace App\Actions\Game;

use App\Models\Game;

final readonly class CalculateGameRatingAction
{
    public function handle(Game $game): ?float
    {
        return $game->reviews->avg('rating');
    }
}
