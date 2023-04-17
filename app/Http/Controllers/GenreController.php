<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::query()
            ->orderBy('title')
            ->limit(100)
            ->get();

        return GenreResource::collection($genres);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Genre $genre)
    {
        //
    }

    public function edit(Genre $genre)
    {
        //
    }

    public function update(Request $request, Genre $genre)
    {
        //
    }

    public function destroy(Genre $genre)
    {
        //
    }
}
