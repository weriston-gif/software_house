<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProjectBudget>
 */
class UserProjectBudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => $this->faker->phoneNumber,
            'rua' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'bairro' => $this->faker->secondaryAddress,
            'cep' => $this->faker->postcode,
            'complemento' => $this->faker->secondaryAddress,
            'municipio' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
            'pais' => $this->faker->country,
        ];
    }
}
