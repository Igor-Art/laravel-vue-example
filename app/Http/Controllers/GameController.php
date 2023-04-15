<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        //
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
