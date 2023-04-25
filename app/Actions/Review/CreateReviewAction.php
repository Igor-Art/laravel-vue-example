<?php

namespace App\Actions\Review;

use App\Events\Review\ReviewCreated;
use App\Exceptions\Reviews\ReviewIsNotUniqueException;
use App\Models\Review;
use Illuminate\Contracts\Bus\Dispatcher;

final readonly class CreateReviewAction
{
    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(
        private Dispatcher $dispatcher,
    ) {}

    /**
     * @param CreateReviewCommand $command
     * @return Review
     * @throws ReviewIsNotUniqueException
     */
    public function handle(CreateReviewCommand $command): Review
    {
        $this->throwIfExists($command->user->id, $command->data->game_id);

        $review = Review::query()->create([
            'user_id' => $command->user->id,
            'game_id' => $command->data->game_id,
            'rating' => $command->data->rating,
            'content' => $command->data->content,
        ]);

        $this->dispatcher->dispatch(new ReviewCreated($review));

        return $review;
    }

    /**
     * @throws ReviewIsNotUniqueException
     */
    private function throwIfExists(int $userId, int $gameId): void
    {
        Review::query()
            ->where('user_id', $userId)
            ->where('game_id', $gameId)
            ->doesntExistOr(static fn () => throw new ReviewIsNotUniqueException($userId, $gameId));
    }
}
