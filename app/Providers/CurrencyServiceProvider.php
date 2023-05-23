<?php

namespace App\Providers;

use App\Services\Currency\CurrencyConfig;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CurrencyConfig::class, static function (Application $app) {
            return new CurrencyConfig(
                $app['config']['currency']['default'],
                $app['config']['currency']['factor'],
                $app['config']['currency']['uses'],
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
