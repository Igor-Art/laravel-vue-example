<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        if (User::query()->exists()) {
            return;
        }

        File::copyDirectory(resource_path('stubs/images'), Storage::disk('public')->path('/'));

        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            GameSeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class,
        ]);

        $this->command->call('app:game-rating-calc');
    }
}
