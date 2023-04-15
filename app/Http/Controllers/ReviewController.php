<?php

namespace App\Http\Controllers;

use App\Filters\Review\GameFilter;
use App\Filters\Review\UserFilter;
use App\Http\Requests\Reviews\ReviewFilterRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(ReviewFilterRequest $request)
    {
        $filterRequest = $request->getDto();

        $reviews = Review::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->filter($filterRequest, [
                GameFilter::class,
                UserFilter::class,
            ])
            ->paginate(5);

        return ReviewResource::collection($reviews);
    }

    public function last()
    {
        $reviews = Review::query()
            ->with(['game', 'user'])
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        return ReviewResource::collection($reviews);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Review $review)
    {
        //
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        //
    }
}
