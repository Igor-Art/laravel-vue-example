<?php

namespace App\Console\Commands;

use App\Actions\Game\CalculateGameRatingAction;
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
    public function handle(CalculateGameRatingAction $calculate): void
    {
        Game::query()
            ->withWhereHas('reviews')
            ->chunk(10, function ($games) use ($calculate) {
                $games->each(function ($game) use ($calculate) {
                    $game->update(['rating' => $calculate->handle($game)]);

                    ++$this->affected;
                });
            });

        $this->info(sprintf('Calc game rating: Affected %d games', $this->affected));
    }
}
