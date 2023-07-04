<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProjectBudgetType>
 */
class UserProjectBudgetTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_project_budget_id' => function () {
                // Retorne o ID de um registro fictício da tabela UserProjectBudget
                return \App\Models\UserProjectBudget::factory()->create()->id;
            },
            'type_id' => function () {
                // Retorne o ID de um registro fictício da tabela Type
                return \App\Models\Type::factory()->create()->id;
            },
            'value_total_page' => $this->faker->numberBetween(100, 1000),
            'browser_support' => $this->faker->randomElement(['Chrome', 'Firefox', 'Safari']),
            'platform' => $this->faker->randomElement(['Web', 'Mobile']),
            'operational_system' => $this->faker->randomElement(['Windows', 'Mac', 'Linux']),
            'printer' => $this->faker->boolean,
            'page_login' => $this->faker->boolean,
            'license_access' => $this->faker->boolean,
            'system_pay' => $this->faker->boolean,
            'final_budget_value' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
