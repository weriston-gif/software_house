<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use App\Services\BudgetService;

class BudgetRegistrationWebController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supportsName = Type::arrayBrowserName();

        return view('budget.budget-web')
            ->with('supportsName', $supportsName);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBudgetTypeRequest $request)
    {
        try {
            // Obtenha os valores do request
            $valuePerPage = $request->input('value_per_page');
            $valuePageLogin = $request->input('value_page_login');
            $systemPay = $request->input('system_pay');
            $idValidate = $request->input('value');
            $browser_support = $request->input('browser_support');
            $type = 1;

            // Calcule o valor total usando o serviço 'BudgetService'
            $totalValue = $this->budgetService->calculateTotalValue($valuePerPage, $valuePageLogin, $type);

            // Registre os dados na tabela 'user_project_budget_types' usando o serviço 'BudgetService'
            $data_mobile = [
                'user_project_budget_id' => $idValidate,
                'valuePerPage' => $valuePerPage,
                'type_id' => $type,
                'browser_support' => $browser_support,
                'value_page_login' => $valuePageLogin,
                'system_pay' => $systemPay,
                'final_budget_value' => $totalValue,
            ];

            $register = $this->budgetService->registerBudget($data_mobile);

            // Verifique se o registro foi bem-sucedido antes de redirecionar
            if ($register) {
                // Redirecione para a action 'show' com o ID do orçamento
                return redirect()->route('budget.show', [
                    'cadastro_orcamento' => $idValidate,
                    'register' => $register,
                ])->with('success', 'Envio bem-sucedido. Orçamento Web registrado com sucesso.');
            } else {
                // Retorne para a mesma tela com uma mensagem de erro
                return redirect()->back()->with('error', 'Erro no registro do orçamento.');
            }
        } catch (\Exception $exception) {
            // Retorne para a mesma tela com uma mensagem de erro
            return redirect()->back()->with('error', 'Erro no envio: '.$exception->getMessage());
        }
    }
}
