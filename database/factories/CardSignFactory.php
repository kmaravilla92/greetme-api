<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardSign>
 */
class CardSignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'message' => fake()->text(),
            'custom_name' => fake()->name(),
            'font_family_id' => 0,
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
        ];
    }
}