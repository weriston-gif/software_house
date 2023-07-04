<?php

use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Services\BudgetService;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

# php artisan test --filter=BudgetServiceTest 

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
}
