<?php

namespace App\Actions\Review;

use App\Dto\Review\ReviewStoreDto;
use App\Models\User;

final readonly class CreateReviewCommand
{
    public function __construct(
        public User $user,
        public ReviewStoreDto $data,
    ) {}
}
