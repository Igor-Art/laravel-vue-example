<?php

namespace App\Console\Commands;

use App\Models\Game;
use Illuminate\Console\Command;

class GameRatingCalc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:game-rating-calc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calc game rating from reviews';

    /**
     * @var int
     */
    private int $affected = 0;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Game::query()
            ->withWhereHas('reviews')
            ->chunk(10, function ($games) {
                $games->each(function ($game) {
                    $game->update(['rating' => $game->reviews->avg('rating')]);

                    ++$this->affected;
                });
            });

        $this->info(sprintf('Calc game rating: Affected %d games', $this->affected));
    }
}
