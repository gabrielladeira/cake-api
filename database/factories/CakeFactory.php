<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price'=> $this->faker->randomFloat(2,9, 300),
            'weight'=> $this->faker->numberBetween(100, 2000),
            'quantity'=> $this->faker->numberBetween(1,100)
        ];
    }
}
