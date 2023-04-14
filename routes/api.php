<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('games/top', [GameController::class, 'top'])->name('games.top');
Route::resource('games', GameController::class);

Route::get('reviews/last', [ReviewController::class, 'last'])->name('reviews.last');
Route::resource('reviews', ReviewController::class);

Route::any('{any}', static fn () => abort(404))->where('any', '.*');
