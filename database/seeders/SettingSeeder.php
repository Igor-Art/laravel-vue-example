<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::query()->insert([
            ['key' => 'github', 'value' => 'https://github.com/Igor-Art/laravel-vue-example'],
        ]);
    }
}
