<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => static fn (array $attributes) => Str::slug($attributes['title']),
            'cover' => fn (array $attributes) => $this->getCoverPath($attributes['slug']),
            'year' => $this->faker->dateTimeBetween('-10 years')->format('Y'),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->optional()->numberBetween(100, 5000),
        ];
    }

    private function getCoverPath(string $slug): ?string
    {
        return $slug.'.jpg';
    }
}
