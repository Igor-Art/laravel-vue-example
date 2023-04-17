<?php

namespace App\Http\Controllers;

use App\Filters\Game\GenreFilter;
use App\Filters\Game\SearchFilter;
use App\Http\Requests\Games\GameFilterRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(GameFilterRequest $request)
    {
        $gameFilter = $request->getDto();

        $games = Game::query()
            ->filter($gameFilter, [
                GenreFilter::class,
                SearchFilter::class,
            ])
            ->orderBy('title')
            ->cursorPaginate(16);

        return GameResource::collection($games);
    }

    public function top()
    {
        $games = Game::query()
            ->orderByDesc('rating')
            ->limit(8)
            ->get();

        return GameResource::collection($games);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Game $game)
    {
        $game->load(['genres']);

        return new GameResource($game);
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
