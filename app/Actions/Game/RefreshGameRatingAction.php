<?php

namespace App\Actions\Game;

use App\Models\Game;

final readonly class RefreshGameRatingAction
{
    public function __construct(
        private CalculateGameRatingAction $calculate,
    ) {}

    public function handle(int $gameId): void
    {
        $game = Game::query()
            ->with('reviews')
            ->findOrFail($gameId);

        $game->update(['rating' => $this->calculate->handle($game)]);
    }
}
