<?php

namespace App\Dto\Review;

use App\Dto\BaseDto;
use App\Filters\FilterRequest;

readonly final class ReviewFilterDto extends BaseDto implements FilterRequest
{
    public function __construct(
        public ?int $game_id = null,
        public ?int $user_id = null,
    ) {}

    public static function getRules(): array
    {
        return [
            'game_id' => ['nullable', 'integer', 'min:1'],
            'user_id' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
