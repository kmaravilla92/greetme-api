<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
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
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
            'parent_id' => 0,
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (ProductCategory $category) {
            $parent = ProductCategory::inRandomOrder()->first();
            $category->parent_id = $parent ? $parent->id : 0;
            $category->save();
        });
    }
}
