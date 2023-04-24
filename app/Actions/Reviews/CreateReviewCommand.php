<?php

namespace App\Actions\Reviews;

use App\Dto\Reviews\ReviewStoreDto;
use App\Models\User;

final readonly class CreateReviewCommand
{
    public function __construct(
        public User $user,
        public ReviewStoreDto $data,
    ) {}
}
