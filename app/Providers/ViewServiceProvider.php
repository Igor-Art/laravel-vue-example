<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('app', AppComposer::class);
    }

    public function register(): void
    {
        //
    }
}
