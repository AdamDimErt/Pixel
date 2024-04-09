<?php

namespace Database\Factories;

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
            'name_ru' => fake()->colorName(),
            'name_en' => fake()->colorName(),
            'cost' => fake()->numberBetween(10000, 50000),
        ];
    }
}
