<?php

namespace App\Dto\Review;

use App\Dto\BaseDto;
use App\Models\Game;
use Illuminate\Validation\Rule;

readonly final class ReviewStoreDto extends BaseDto
{
    public function __construct(
        public int $game_id,
        public int $rating,
        public string $content,
    ) {}

    public static function getRules(): array
    {
        return [
            'game_id' => ['required', 'integer', Rule::exists(Game::class, 'id')],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'max:1000'],
        ];
    }
}
