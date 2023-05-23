<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function current(Request $request)
    {
        return new UserResource($request->user());
    }

    public function show(User $user)
    {
        $user->loadCount(['reviews', 'wishlist']);

        return new ProfileResource($user);
    }

    public function wishlist(User $user)
    {
        $games = $user->wishlist()->cursorPaginate(8);

        return GameResource::collection($games);
    }

    public function reviews(User $user)
    {
        $reviews = $user->reviews()
            ->with(['game'])
            ->orderByDesc('created_at')
            ->cursorPaginate(5);

        return ReviewResource::collection($reviews);
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
