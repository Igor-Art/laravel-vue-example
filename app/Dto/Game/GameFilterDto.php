<?php

namespace App\Dto\Game;

use App\Dto\BaseDto;
use App\Filters\FilterRequest;

readonly final class GameFilterDto extends BaseDto implements FilterRequest
{
    public function __construct(
        public ?array $genres = null,
        public ?string $search = null,
        public ?bool $is_free = null,
    ) {}

    public static function getRules(): array
    {
        return [
            'genres' => ['nullable', 'array', 'max:5'],
            'genres.*' => ['required', 'integer', 'min:1'],
            'search' => ['nullable', 'string', 'min:2', 'max:50'],
            'is_free' => ['nullable', 'boolean'],
        ];
    }
}
