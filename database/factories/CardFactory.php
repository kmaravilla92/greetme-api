<?php

namespace Database\Factories;

use App\Models\CardTemplateCategory;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $future_weeks = fake()->numberBetween(1, 52);

        return [
            'type' => fake()->randomElement([
                'individual',
                'group',
            ]),
            'receiver_name' => fake()->name(),
            'receiver_email' => fake()->email(),
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => fake()->randomElement([
                'active',
                'inactive',
            ]),
            'scheduled_at' => fake()->dateTime(new DateTime("+{$future_weeks} weeks")),
        ];
    }
}