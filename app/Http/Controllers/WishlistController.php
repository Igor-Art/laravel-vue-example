<?php

namespace App\Http\Controllers;

use App\Http\Responses\SuccessfulResponse;
use App\Models\Game;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Request $request, Game $game): Responsable
    {
        $request->user()->wishlist()->toggle($game);

        return new SuccessfulResponse;
    }
}
