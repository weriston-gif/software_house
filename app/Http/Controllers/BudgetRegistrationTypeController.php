<?php

namespace App\Http\Controllers;

use App\DTO\BudgetRegistrationTypeDTO;
use App\DTO\BudgetRegistrationTypeUpdateDTO;
use App\DTO\UserProjectBudgetTypeDTO;
use App\Http\Requests\BudgetUpdateRequest;
use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BudgetRegistrationTypeController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBudgetTypeRequest $request)
    {

        try {

            $totalValue = $this->budgetService->calculateTotalValue($request->value_total_page, $request->page_login, $request->type_id);
            $userProjectBudgetTypeDTO = new BudgetRegistrationTypeDTO($request, $totalValue);
            $register =  $this->budgetService->registerBudget($userProjectBudgetTypeDTO->toArray());

            // Verifique se o registro foi bem-sucedido antes de redirecionar
            if ($register) {
                // Redirecione para a action 'show' com o ID do orçamento
                return redirect()->route('cadastro-orcamento-tipo.edit', [
                    'cadastro_orcamento_tipo' => $register,
                ])->with('success', 'Envio bem-sucedido. Orçamento registrado com sucesso gostaria de editar.');
            } else {
                // Retorne para a mesma tela com uma mensagem de erro
                return redirect()->back()->with('error', 'Erro no registro do orçamento.');
            }
        } catch (\Exception $exception) {
            // Retorne para a mesma tela com uma mensagem de erro
            Log::error('Erro no registro do orçamento:', ['exception' => $exception]);

            return redirect()->back()->with('error', 'Erro no envio: ' . $exception->getMessage());
        }
    }

    public function edit(string $cadastro_orcamento_tipo): View
    {
        $data_user = $this->budgetService->getFilteredBudgetForUser($cadastro_orcamento_tipo);

        if (!$data_user) {
            abort(404, 'Registro não encontrado.');
        }
        $types = Type::arrayTypes();

        // Retorna a visualização 'budget.show' passando as variáveis $data_users
        return view('budget.edit', compact('data_user', 'types'));
    }

    public function update(BudgetUpdateRequest $request)
    {
        try {


            $totalValue = $this->budgetService->calculateTotalValue($request->value_total_page, $request->page_login, $request->type_id);

            $userProjectBudgetTypeUpdateDTO = new BudgetRegistrationTypeUpdateDTO($request, $totalValue);
         
            $data_user_persona = $userProjectBudgetTypeUpdateDTO->getUserPersonaData();
            $data_user_types = $userProjectBudgetTypeUpdateDTO->getUserTypesData();

            $this->budgetService->updateBudgetForUserType($request->user_project_budget_id, $request->user_project_budget_type_id, $data_user_persona, $data_user_types);


            // Retornar uma resposta de sucesso, redirecionar ou fazer qualquer outra coisa necessária
            return redirect()->back()->with('success', 'Orçamento atualizado com sucesso! Enviamos para seu e-mail os dados');
        } catch (\Exception $e) {
            // Capturar a exceção e lidar com ela adequadamente
            // Por exemplo, você pode registrar a exceção, exibir uma mensagem de erro, redirecionar para uma página de erro, etc.

            // Exemplo de registro de exceção:
            Log::error('Erro durante a atualização do orçamento:', ['exception' => $e]);

            // Exemplo de redirecionamento para uma página de erro com mensagem de erro
            return redirect()->back()->with('error', 'Erro no envio: ' . $e->getMessage());
        }
    }
}
