<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardTemplateCategory>
 */
class CardTemplateCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->text(25);

        return [
            'name' => $name,
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name'], '-');
            },
            'description' => fake()->text(100),
            'parent_id' => 0,
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
        ];
    }
}