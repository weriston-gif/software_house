<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use App\Services\BudgetService;
use Illuminate\Http\Request;

class BudgetRegistrationDesktopController extends Controller
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
        $supportsName = Type::arrayOperacionalSystemName();

        return view('budget.budget-desktop')
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
        $operational_system = $request->input('operational_system');
        $printer = $request->input('printer');
        $license_access = $request->input('license_access');

        $type = 3;

        // Calcule o valor total usando o serviço 'BudgetService'
        $totalValue = $this->budgetService->calculateTotalValue($valuePerPage, $valuePageLogin, $type);

        // Registre os dados na tabela 'user_project_budget_types' usando o serviço 'BudgetService'
        $data_desktop = [
            'user_project_budget_id' => $idValidate,
            'type_id' => $type,
            'valuePerPage' => $valuePerPage,

            'operational_system' => $operational_system,

            'value_page_login' => $valuePageLogin,

            'printer' => $printer,
            'license_access' => $license_access,

            'final_budget_value' => $totalValue,
        ];

        $register = $this->budgetService->registerBudget($data_desktop);

        // Redirecione para a action 'show' com o ID do orçamento
        return redirect()->route('budget.show', [
            'cadastro_orcamento' => $idValidate,
            'register' => $register,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
