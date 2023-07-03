<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
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
        
        $regsiter = $this->budgetService->registerBudget($data_mobile);
        $send = $this->budgetService->sendBuget($idValidate);

        // Redirecione para uma rota de sucesso ou retorne uma resposta adequada

        return view('budget.budget-mobile');
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
