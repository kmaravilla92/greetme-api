<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardTemplatePart>
 */
class CardTemplatePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'cover_image',
                'cover_back_image',
                'inside_image',
                'inside_note',
                'back_image',
                'back_note',
            ]),
            'image_id' => 0,
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
            'card_template_id' => 0,
        ];
    }
}
