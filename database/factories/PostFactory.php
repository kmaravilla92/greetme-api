<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(50),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['title'], '-');
            },
            'content' => fake()->text(),
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
        ];
    }
}
