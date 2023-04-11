<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('games/top', [GameController::class, 'top'])->name('games.top');
Route::resource('games', GameController::class);

Route::any('{any}', static fn () => abort(404))->where('any', '.*');
