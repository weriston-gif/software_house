<?php

namespace Tests\App\Http\Controllers;

use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Observers\TypeObserver;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

// php artisan test --filter=sendEmailControllerTest

class sendEmailControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware; // use this trait

    /**
     * A basic test example.
     */
    public function test_send_email_user()
    {
        $user = UserProjectBudget::factory()->create();
        // Crie um registro fictício na tabela UserProjectBudgetType relacionado ao UserProjectBudget criado
        $userProjectBudgetType = UserProjectBudgetType::factory()->create(['user_project_budget_id' => $user->id]);

        // Execute a notificação passando o ID do UserProjectBudget criado
        $response = $this->post("cadastro-orcamento-send/{$user->id}");

        // Verifique se a resposta tem status 302 (redirecionamento)
        $response->assertStatus(302); 
        // Verifique se a mensagem de sucesso está presente na sessão
        $this->assertEquals('Orçamento enviado com sucesso.', session('success'));
    }

    public function testDeletedMethod()
    {
        // Cria uma instância do modelo Type para usar no teste
        $type = new Type();

        // Configura o comportamento esperado do Notification facade
        Notification::fake();

        // Cria uma instância do observer
        $observer = new TypeObserver();

        // Chama o método deleted passando o modelo Type
        $result = $observer->deleted($type);

        // Verifica as asserções do teste
        $this->assertTrue($result);
    }
}
