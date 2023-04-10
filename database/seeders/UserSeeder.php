<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->state([
                'name' => 'Admin',
                'email' => 'admin@localhost'
            ])
            ->create();

        User::factory()
            ->count(10)
            ->create();
    }
}
