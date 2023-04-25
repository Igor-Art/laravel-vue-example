<?php

namespace App\Http\Controllers;

use App\Actions\Review\CreateReviewAction;
use App\Actions\Review\CreateReviewCommand;
use App\Filters\Review\GameFilter;
use App\Filters\Review\UserFilter;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewFilterRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only([
            'store', 'update', 'destroy',
        ]);
    }

    public function index(ReviewFilterRequest $request)
    {
        $filterRequest = $request->getDto();

        $reviews = Review::query()
            ->with(['game', 'user'])
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

    public function show(Review $review)
    {
        //
    }

    public function store(ReviewStoreRequest $request, CreateReviewAction $createReviewAction)
    {
        $review = $createReviewAction->handle(
            new CreateReviewCommand($request->user(), $request->getDto())
        );

        return response()->json([
            'message' => __('Review created successfully.'),
            'review' => new ReviewResource($review),
        ]);
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
