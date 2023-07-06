<?php

namespace Tests\App\Service;

use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Services\BudgetService;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

// php artisan test --filter=BudgetServiceTest

class BudgetServiceTest extends TestCase
{
    public function testRegisterBudgetValidationFailure()
    {
        // Dados fictícios inválidos para forçar a falha na validação
        $data = [
            'user_project_budget_id' => 1,
            'type_id' => 4,
            // Outros campos necessários ausentes
        ];

        // Chame o método registerBudget() da classe BudgetService
        $budgetService = new BudgetService();

        // Verifique se ocorre uma exceção de validação ao chamar o método com dados inválidos
        $this->expectException(ValidationException::class);
        $budgetService->registerBudget($data);
    }

    public function testGetFilteredBudgetForUser()
    {
        // Crie um registro fictício na tabela UserProjectBudgetType
        $userProjectBudgetType = UserProjectBudgetType::factory()->create();

        // Execute o método getFilteredBudgetForUser passando o ID do registro criado
        $budgetService = new BudgetService();
        $result = $budgetService->getFilteredBudgetForUser($userProjectBudgetType->id);

        // Verifique se o resultado é um array e possui as chaves esperadas
        $this->assertIsArray($result);
        $this->assertArrayNotHasKey('created_at', $result);
        $this->assertArrayNotHasKey('updated_at', $result);
    }

    public function testCalculateTotalValue()
    {
        // Cria uma instância do serviço
        $service = new BudgetService();

        // Cria um modelo Type fictício para usar no teste
        $type = Type::factory()->create([
            'value_per_page' => 10.3,
            'value_page_login' => 19.5,
        ]);

        // Chama o método calculateTotalValue com os valores de teste
        $valuePerPage = 10;
        $valuePageLogin = 1;
        $totalValue = $service->calculateTotalValue($valuePerPage, $valuePageLogin, $type->id);

        // Verifica se o valor total calculado está correto
        $expectedTotalValue = ($type->value_per_page * $valuePerPage) + $type->value_page_login;
        $this->assertEquals($expectedTotalValue, $totalValue);
    }

    public function testUpdateBudgetForUserType()
    {
        // Cria um registro fictício de UserProjectBudget para usar no teste
        $budgetUser = UserProjectBudget::factory()->create();

        // Cria um registro fictício de UserProjectBudgetType para usar no teste
        $budgetUserType = UserProjectBudgetType::factory()->create();

        // Dados fictícios para atualizar o UserProjectBudget
        $dataUserPersona = [
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
        // Dados fictícios para atualizar o UserProjectBudgetType
        $dataUserTypes = [
            'final_budget_value' => 100.0, // Insira aqui o valor correto para $totalValue
            'value_total_page' => 10, // Insira aqui o valor correto para $valuePerPage
            'type_id' => 1, // Insira aqui o valor correto para $type
            'platform' => 'Some platform', // Insira aqui o valor correto para $platform
            'page_login' => 1, // Insira aqui o valor correto para $valuePageLogin
            'system_pay' => true, // Insira aqui o valor correto para $systemPay
            'license_access' => true, // Insira aqui o valor correto para $licenseAccess
            'printer' => true, // Insira aqui o valor correto para $printer
            'operational_system' => 'Some OS', // Insira aqui o valor correto para $operationalSystem
            'browser_support' => 'Some browser support', // Insira aqui o valor correto para $browserSupport
        ];

        // Chama o método updateBudgetForUserType com os dados de teste
        $service = new BudgetService();
        $result = $service->updateBudgetForUserType($budgetUser->id, $budgetUserType->id, $dataUserPersona, $dataUserTypes);

        // Verifica se o método retornou true (ou seja, a atualização foi bem-sucedida)
        $this->assertTrue($result);

        // Verifica se o UserProjectBudget foi atualizado corretamente
        $updatedBudgetUser = UserProjectBudget::findOrFail($budgetUser->id);
        $this->assertEquals($dataUserPersona['name'], $updatedBudgetUser->name);
        $this->assertEquals($dataUserPersona['email'], $updatedBudgetUser->email);
        // Verifique outros campos atualizados conforme necessário

        // Verifica se o UserProjectBudgetType foi atualizado corretamente
        $updatedBudgetUserType = UserProjectBudgetType::findOrFail($budgetUserType->id);
        $this->assertEquals($dataUserTypes['type_id'], $updatedBudgetUserType->type_id);
        // Verifique outros campos atualizados conforme necessário

    }
}
