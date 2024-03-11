<?php

namespace Database\Factories;

use App\Models\Good;
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
            'description' => fake()->unique()->safeEmail(),
            'cost' => fake()->numberBetween(10000, 50000),
            'discount_cost' => rand(0, 1) ? fake()->numberBetween(10000, 50000) : null,
            'related_goods' => json_encode(Good::query()->inRandomOrder()->pluck('id')),
            'good_type_id' => GoodType::query()->inRandomOrder()->first(),
        ];
    }
}
