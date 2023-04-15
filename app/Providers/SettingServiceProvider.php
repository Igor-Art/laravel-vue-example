<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $settings = Cache::rememberForever('app_settings', static function () {
            try {
                return Setting::pluck('value', 'key')->toArray() ?: null;

            } catch (\Throwable $e) {
                return null;
            }
        });

        Config::set('settings', $settings);
    }

    public function register(): void
    {
        //
    }
}
