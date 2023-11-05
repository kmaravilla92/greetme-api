<?php

namespace Database\Factories;

use App\Models\CardTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardTemplate>
 */
class CardTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(50),
            'description' => fake()->text(100),
            'designer' => fake()->name(),
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
        ];
    }
}