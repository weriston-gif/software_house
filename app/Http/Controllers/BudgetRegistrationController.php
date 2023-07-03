<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Models\Type;
use App\Models\UserProjectBudget;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class BudgetRegistrationController extends Controller
{
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
    public function create(): View
    {
        return view('budget.create');
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
