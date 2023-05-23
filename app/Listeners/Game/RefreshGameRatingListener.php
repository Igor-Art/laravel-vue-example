<?php

namespace App\Listeners\Game;

use App\Actions\Game\RefreshGameRatingAction;
use App\Events\Review\ReviewCreated;
use App\Events\Review\ReviewUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;

final readonly class RefreshGameRatingListener implements ShouldQueue
{
    public function __construct(
        private RefreshGameRatingAction $refreshGameRating
    ) {}

    public function handleFromReview(ReviewCreated|ReviewUpdated $event): void
    {
        if ($event instanceof ReviewUpdated && !$event->review->wasChanged('rating')) {
            return;
        }

        $this->refreshGameRating->handle($event->review->game_id);
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            ReviewCreated::class => 'handleFromReview',
            ReviewUpdated::class => 'handleFromReview',
        ];
    }
}
