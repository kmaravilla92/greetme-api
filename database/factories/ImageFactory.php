<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = fake()->randomElement(
            Storage::files('images')
        );
        
        return [
            'url' => asset($path),
            'path' => $path,
            'alt_text' => fake()->text(20),
            'width' => 640,
            'height' => 480,
            'user_id' => 0,
            'parent_id' => 0,
        ];
    }
}