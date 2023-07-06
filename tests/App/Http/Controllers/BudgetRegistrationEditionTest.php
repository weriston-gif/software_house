<?php

namespace Tests\App\Http\Controllers;

use App\Models\UserProjectBudgetType;
use Tests\TestCase;

// php artisan test --filter=BudgetRegistrationEditionTest

class BudgetRegistrationEditionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_edit_method_returns_view_with_data()
    {
        // Criação dos modelos usando as factories correspondentes
        $cadastroOrcamentoTipo = UserProjectBudgetType::factory()->create();

        // Chamada do método edit passando o ID do cadastro_orcamento_tipo
        $response = $this->get(route('cadastro-orcamento-tipo.edit', $cadastroOrcamentoTipo->id));

        $response->assertStatus(200)
            ->assertViewIs('budget.edit')
            ->assertViewHas(['data_user', 'types']);

    }

    public function test_edit_method_returns_404_for_nonexistent_record()
    {
        // Chamada do método edit com um ID inexistente
        $response = $this->get(route('cadastro-orcamento-tipo.edit', 999));

        $response->assertStatus(404);
    }
}
