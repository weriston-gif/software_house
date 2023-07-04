<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class BudgetRegistrationController extends Controller
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
        $type = Type::getAllTypes();

        return view('budget.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBudgetRequest $request)
    {

        try {
            // Os dados já foram validados pelo form request

            // Criação de um novo registro de budget
            $budget = UserProjectBudget::create($request->validated());

            // Armazena o ID do budget na sessão
            Session::put('budgetId', $budget->id);

            return redirect()->route('cadastro-orcamento.index')->with([
                'success' => 'Dados criados com sucesso. Envie o orçamento para o e-mail: ' . $request->email,
                'budgetId' => $budget->id,
            ]);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Erro ao criar o budget: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, $register): view
    {

        $budgetValue = UserProjectBudgetType::join('user_project_budgets', 'user_project_budget_types.user_project_budget_id', '=', 'user_project_budgets.id')
            ->where('user_project_budgets.id', $id)
            ->where('user_project_budget_types.id', $register)
            ->select(
                'user_project_budgets.name AS name',
                'user_project_budgets.email AS email',
                'user_project_budgets.telefone AS telefone',
                'user_project_budget_types.id AS id_register',
                'user_project_budget_types.type_id AS type',
                'user_project_budget_types.user_project_budget_id AS user_id',
                'user_project_budget_types.value_total_page AS valuePerPage',
                'user_project_budget_types.browser_support AS suport_browser',
                'user_project_budget_types.platform AS platform',
                'user_project_budget_types.operational_system AS sistema_operacional',
                'user_project_budget_types.printer AS printer',
                'user_project_budget_types.license_access AS license_access',
                'user_project_budget_types.system_pay AS system_pay',
                'user_project_budget_types.final_budget_value AS final_budget_value'
            )
            ->first();
        if (!$budgetValue) {
            abort(404, 'Registro não encontrado.');
        }


        $this->budgetService->sendBuget($id);

        // Retorna a visualização 'budget.show' passando as variáveis $budgetValues
        return view('budget.show', compact('budgetValue'));
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
        dd('aqui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
