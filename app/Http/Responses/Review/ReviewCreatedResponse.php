<?php

namespace App\Http\Responses\Review;

use App\Http\Resources\ReviewResource;
use App\Http\Responses\ApiResponse;
use App\Models\Review;

class ReviewCreatedResponse extends ApiResponse
{
    public function __construct(Review $review)
    {
        $this->setMessage(__('Review created successfully.'));
        $this->setPayload(new ReviewResource($review));
        $this->setStatus(201);
    }
}
