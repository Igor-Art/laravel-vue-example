<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('games/top', [GameController::class, 'top'])->name('games.top');
Route::get('games/{game}/reviews', [GameController::class, 'reviews'])->name('games.show.reviews');

Route::resource('games', GameController::class)
    ->parameters(['games' => 'game:slug'])
    ->except(['create', 'edit']);

Route::get('reviews/last', [ReviewController::class, 'last'])->name('reviews.last');

Route::resource('reviews', ReviewController::class)->except(['create', 'edit']);

Route::resource('genres', GenreController::class)->except(['create', 'edit']);

Route::get('auth/user', [UserController::class, 'current'])
    ->middleware('auth:sanctum')
    ->name('auth.user');

Route::resource('users', UserController::class)
    ->except(['create', 'store', 'edit']);

Route::any('{any}', static fn () => abort(404))->where('any', '.*');
