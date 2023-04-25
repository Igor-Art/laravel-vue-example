<?php

namespace App\Actions\Reviews;

use App\Dto\Review\ReviewStoreDto;
use App\Models\User;

final readonly class CreateReviewCommand
{
    public function __construct(
        public User $user,
        public ReviewStoreDto $data,
    ) {}
}
