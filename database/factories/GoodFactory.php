<?php

namespace Database\Factories;

use App\Models\GoodType;
use Illuminate\Database\Eloquent\Factories\Factory;


class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->colorName(),
            'title' => fake()->unique()->safeEmail(),
            'description' => fake()->unique()->safeEmail(),
            'cost' => fake()->numberBetween(10000, 50000),
            'good_type_id' => GoodType::query()->inRandomOrder()->first(),
        ];
    }
}
