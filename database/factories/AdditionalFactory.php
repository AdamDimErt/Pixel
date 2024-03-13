<?php

namespace Database\Factories;

use App\Models\Additional;
use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdditionalFactory extends Factory
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
            'cost' => fake()->numberBetween(10000, 50000),
        ];
    }
}
