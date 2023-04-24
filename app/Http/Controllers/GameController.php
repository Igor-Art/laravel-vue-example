<?php

namespace App\Http\Controllers;

use App\Filters\Game\GenreFilter;
use App\Filters\Game\PriceFilter;
use App\Filters\Game\SearchFilter;
use App\Http\Requests\Games\GameFilterRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\ReviewResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(GameFilterRequest $request)
    {
        $gameFilter = $request->getDto();

        $games = Game::query()
            ->withCount(['reviews'])
            ->filter($gameFilter, [
                GenreFilter::class,
                SearchFilter::class,
                PriceFilter::class,
            ])
            ->orderBy('title')
            ->cursorPaginate(16);

        return GameResource::collection($games);
    }

    public function top()
    {
        $games = Game::query()
            ->withCount(['reviews'])
            ->orderByDesc('rating')
            ->limit(8)
            ->get();

        return GameResource::collection($games);
    }

    public function reviews(Game $game)
    {
        $reviews = $game->reviews()
            ->with(['user'])
            ->paginate(5);

        return ReviewResource::collection($reviews);
    }

    public function show(Request $request, Game $game)
    {
        $game->load(['genres']);

        if ($request->user()) {
            $game->loadExists([
                'userWishlist' => static fn ($query) => $query->where('user_id', $request->user()->id),
                'userReview' => static fn ($query) => $query->where('user_id', $request->user()->id),
            ]);
        }

        return new GameResource($game);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Game $game)
    {
        //
    }

    public function destroy(Game $game)
    {
        //
    }
}
