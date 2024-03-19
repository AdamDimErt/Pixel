<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchid\Platform\Models\User;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first(),
            'status' => ['in_rent', 'returned'][$this->faker->numberBetween(0, 1)],
            'amount_paid' => $this->faker->randomNumber(),
        ];
    }
}
