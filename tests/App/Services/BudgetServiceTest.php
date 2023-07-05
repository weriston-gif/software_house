<?php

use App\Models\Type;
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
}
