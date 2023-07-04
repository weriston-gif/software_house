<?php

namespace Tests\App\Http\Controllers;

use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;


# php artisan test --filter=sendEmailControllerTest

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
        $response->assertStatus(302); // Ele se dá esse status pois ele volta para tela de orçamentos

        // Verifique se a mensagem de sucesso está presente na sessão
        $this->assertEquals('Orçamento enviado com sucesso.', session('success'));
    }
}
