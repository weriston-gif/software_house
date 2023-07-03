<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Models\Type;
use Throwable;
use App\Models\UserProjectBudget;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
    }

    public function indexMobile(Request $request): view
    {
        $budgetId = $request->input('id');

        dd($budgetId);
        $supportsName = Type::arraySupportsName();

        return view('budget.budget-mobile')
            ->with('supportsName', $supportsName);
    }

    public function create()
    {
        return view('budget.create');
    }

    public function store(CreateBudgetRequest $request)
    {
        try {
            // Os dados já foram validados pelo form request

            // Criação de um novo registro de budget
            $budget = UserProjectBudget::create($request->validated());
            return redirect()->route('budget.index')->with('success', 'Dados criado com sucesso, envia orçamento para E-mail: ' . $request->email)->with('budgetId', $budget->id);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Erro ao criar o budget: ' . $e->getMessage());
        }
    }
}
