<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->word,
            'value_page_login' => $this->faker->randomFloat(2, 10, 100),
            'value_per_page' => $this->faker->randomFloat(2, 1, 10),
        ];
    }
}
