<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Request $request, Game $game)
    {
        $request->user()->wishlist()->toggle($game);

        return response()->json();
    }
}
