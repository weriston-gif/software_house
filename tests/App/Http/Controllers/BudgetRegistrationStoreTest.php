<?php

namespace Tests\App\Http\Controllers;

use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Services\BudgetService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;


// php artisan test --filter=BudgetRegistrationStoreTest

class BudgetRegistrationStoreTest extends TestCase
{
    use WithoutMiddleware; // use this trait

    public function testStore()
    {
        // Crie um registro inicial na tabela user_project_budget_types
        UserProjectBudgetType::factory()->create([
            'user_project_budget_id' => 1,
            'value_total_page' => 12,
            'type_id' => 3,
            'platform' => 'TESTE',
            'page_login' => true,
            'system_pay' => false,
            'final_budget_value' => 123,
            'license_access' => true,
            'printer' => true,
            'operational_system' => '0',
            'browser_support' => '0',
        ]);

        $budgetTypeData = [
            'user_project_budget_id' => 1,
            'value_total_page' => 12,
            'type_id' => 3,
            'platform' => 'TESTE',
            'page_login' => true,
            'system_pay' => false,
            'final_budget_value' => 123,
            'license_access' => true,
            'printer' => true,
            'operational_system' => '0',
            'browser_support' => '0',
        ];

        // Simule a solicitação HTTP POST contendo os parâmetros do formulário
        $response = $this->post('/cadastro-orcamento-tipo', $budgetTypeData);

        // Verifique se a resposta tem o status esperado
        $response->assertStatus(302);

        // Verifique se o registro foi criado no banco de dados
        $this->assertDatabaseHas('user_project_budget_types', $budgetTypeData);
    }

    public function testEdit()
    {
        // Crie um registro inicial na tabela user_project_budget_types
        $budgetType = UserProjectBudgetType::factory()->create();


        // Simule a solicitação HTTP PATCH para a rota de atualização
        $response = $this->patch(route('cadastro-orcamento-tipo.update', ['cadastro_orcamento_tipo' => $budgetType->id]));
        // Verifique se a resposta tem o status esperado
        $response->assertStatus(302); // Ou outro status esperado, dependendo da lógica do seu controlador

        // Verifique se o registro foi atualizado no banco de dados
        $this->assertDatabaseHas('user_project_budget_types', array_merge(['id' => $budgetType->id]));
    }
    public function testUpdate()
    {
        // Crie um registro inicial na tabela user_project_budgets
        $userProjectBudget = UserProjectBudget::factory()->create([
            'name' => 'Ficticio da Silva',
            'email' => 'noreplay@noreplay.com',
            'telefone' => '11 0000-0000',
            'cep' => '00000-000',
            'rua' => '12',
            'numero' => '13',
            'bairro' => 'boa vista',
            'complemento' => '',
            'municipio' => 'São Paulo',
            'uf' => 'SP',
            'pais' => 'brazil',
        ]);

        // Crie um registro inicial na tabela user_project_budget_types relacionado ao user_project_budget
        $userProjectBudgetType = UserProjectBudgetType::factory()->create([
            'user_project_budget_id' => $userProjectBudget->id,
            'final_budget_value' => 134.00,
            'value_total_page' => 12,
            'type_id' => 1,
            'platform' => 'Teste',
            'page_login' => true,
            'system_pay' => true,
            'license_access' => false,
            'printer' => false,
            'operational_system' => '0',
            'browser_support' => '0',
        ]);

        $data_user_all = [
            'id' => $userProjectBudgetType->id,
            'id_budget' => $userProjectBudgetType->user_project_budget_id,
            'name' => $userProjectBudget->name,
            'email' => $userProjectBudget->email,
            'telefone' => $userProjectBudget->telefone,
            'cep' => $userProjectBudget->cep,
            'rua' => $userProjectBudget->rua,
            'numero' => $userProjectBudget->numero,
            'bairro' => $userProjectBudget->bairro,
            'municipio' => $userProjectBudget->municipio,
            'uf' => $userProjectBudget->uf,
            'pais' => $userProjectBudget->pais,
            'final_budget_value' => 1334.00,
            'value_total_page' => 12,
            'type_id' => 1,
            'platform' => 'Teste update',
            'page_login' => true,
            'system_pay' => true,
            'license_access' => false,
            'printer' => false,
            'operational_system' => '0',
            'browser_support' => '0',

        ];

        $data_user = [
            'id' => $userProjectBudgetType->id,
            'id_budget' => $userProjectBudgetType->user_project_budget_id,
            'name' => $userProjectBudget->name,
            'email' => $userProjectBudget->email,
            'telefone' => $userProjectBudget->telefone,
            'cep' => $userProjectBudget->cep,
            'rua' => $userProjectBudget->rua,
            'numero' => $userProjectBudget->numero,
            'bairro' => $userProjectBudget->bairro,
            'municipio' => $userProjectBudget->municipio,
            'uf' => $userProjectBudget->uf,
            'pais' => $userProjectBudget->pais,
        ];

        $data_user_types = [
            'final_budget_value' => 1334.00,
            'value_total_page' => 12,
            'type_id' => 1,
            'platform' => 'Teste update',
            'page_login' => true,
            'system_pay' => true,
            'license_access' => false,
            'printer' => false,
            'operational_system' => '0',
            'browser_support' => '0',
        ];

        $response = $this->patch(route('cadastro-orcamento-tipo.update', ['cadastro_orcamento_tipo' => $userProjectBudgetType->id]), $data_user_all);
        $response->assertStatus(302); // Ou outro status esperado, dependendo da lógica do seu controlador
        
        // Chame a função de atualização e verifique se retorna true
        $budgetService = new BudgetService(); // Substitua pela instância real do seu serviço
        $updated = $budgetService->updateBudgetForUserType($userProjectBudget->id, $userProjectBudgetType->id, $data_user, $data_user_types);
        $this->assertTrue($updated);

        // Verifique se o registro foi atualizado no banco de dados
        $this->assertDatabaseHas('user_project_budget_types', array_merge(['id' => $userProjectBudgetType->id], $data_user_types));
    }
}
