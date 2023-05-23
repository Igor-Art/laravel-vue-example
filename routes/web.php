<?php

use Illuminate\Support\Facades\Route;

Route::view('/reset-password/{token}', 'app')
    ->middleware(['guest:'.config('fortify.guard')])
    ->name('password.reset');

Route::view('{any}', 'app')->where('any', '.*');
