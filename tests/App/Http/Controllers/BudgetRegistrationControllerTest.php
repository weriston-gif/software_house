<?php

namespace Tests\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

// php artisan test --filter=BudgetRegistrationControllerTest

class BudgetRegistrationControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     */
    public function test_store_method_creates_budget_and_redirects()
    {

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'rua' => 'Street 1',
            'bairro' => 'Neighborhood',
            'numero' => '123',
            'cep' => '12345-678',
            'municipio' => 'City',
            'uf' => 'State',
            'pais' => 'Country',
            'user_project_budget_type_id' => 1,
        ];

        $response = $this->post(route('cadastro-orcamento.store'), $data);

        $response->assertRedirect(route('cadastro-orcamento.index'))
            ->assertSessionHas('success');

    }
}
