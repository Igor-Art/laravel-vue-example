<?php

namespace App\Events\Review;

use App\Models\Review;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final readonly class ReviewUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Review $review,
    ) {}
}
