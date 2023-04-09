<?php

use Illuminate\Support\Facades\Route;

Route::any('{any}', static fn () => abort(404))->where('any', '.*');
