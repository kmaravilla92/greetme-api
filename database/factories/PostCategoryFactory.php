<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostCategory>
 */
class PostCategoryFactory extends Factory
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
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name'], '-');
            },
            'description' => fake()->text(),
            'parent_id' => 0,
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
        ];
    }
    
    public function configure(): static
    {
        return $this->afterMaking(function (PostCategory $category) {
            $parent = PostCategory::inRandomOrder()->first();
            $category->parent_id = $parent ? $parent->id : 0;
            $category->save();
        });
    }
}
