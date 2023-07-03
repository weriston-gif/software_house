<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class BudgetRegistrationMobileController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }



    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $supportsName = Type::arraySupportsName();



        return view('budget.budget-mobile')
            ->with('supportsName', $supportsName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CreateBudgetTypeRequest $request)
    {

        // Se a validação passou, obtenha os valores do request
        $valuePerPage = $request->input('value_per_page');
        $valuePageLogin = $request->input('value_page_login');
        $idValidate = $request->input('value');
        $platform = $request->input('platform');
        $systemPay = $request->input('system_pay');
        $type = 2;

        // Calcule o valor total usando o serviço 'BudgetService'
        $totalValue = $this->budgetService->calculateTotalValueMobile($valuePerPage, $valuePageLogin);

        // Registre os dados na tabela 'user_project_budget_types' usando o serviço 'BudgetService'
        $data_mobile = [
            'user_project_budget_id' => $idValidate,
            'type_id' => $type,
            'platform' => $platform,
            'value_page_login' => $valuePageLogin,
            'system_pay' => $systemPay,
            'final_budget_value' => $totalValue,
        ];

        $register = $this->budgetService->registerBudget($data_mobile);

        // Redirecione para a action 'show' com o ID do orçamento
        return redirect()->route('budget.show', [
            'cadastro_orcamento_mobile' => $idValidate,
            'register' => $register,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id, $register)
    {

        $budgetValues = UserProjectBudgetType::join('user_project_budgets', 'user_project_budget_types.user_project_budget_id', '=', 'user_project_budgets.id')
            ->where('user_project_budgets.id', $id)
            ->where('user_project_budget_types.id', $register)
            ->select(
                'user_project_budgets.name AS name',
                'user_project_budgets.email AS email',
                'user_project_budgets.telefone AS telefone',
                'user_project_budget_types.browser_support AS suport_browser',
                'user_project_budget_types.platform AS platform',
                'user_project_budget_types.operational_system AS sistema_operacional',
                'user_project_budget_types.printer AS printer',
                'user_project_budget_types.license_access AS license_access',
                'user_project_budget_types.system_pay AS system_pay',
                'user_project_budget_types.final_budget_value AS final_budget_value'
            )
            ->get();



        //$send = $this->budgetService->sendBuget($id);

        // Retorna a visualização 'budget.show' passando as variáveis $data e $budgetValues
        return view('budget.show', [
            'budgetValues' => $budgetValues
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
