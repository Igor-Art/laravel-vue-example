<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('games/top', [GameController::class, 'top'])->name('games.top');

Route::resource('games', GameController::class)
    ->parameters(['games' => 'game:slug'])
    ->except(['create', 'edit']);

Route::get('reviews/last', [ReviewController::class, 'last'])->name('reviews.last');

Route::resource('reviews', ReviewController::class)->except(['create', 'edit']);

Route::resource('genres', GenreController::class)->except(['create', 'edit']);

Route::resource('users', UserController::class)
    ->except(['create', 'store', 'edit']);

Route::any('{any}', static fn () => abort(404))->where('any', '.*');
