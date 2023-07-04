<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Http\Requests\CreateBudgetTypeRequest;
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
        $data_user = $this->budgetService->getFilteredBudgetForUser($register);


        if (!$data_user) {
            abort(404, 'Registro não encontrado.');
        }


        // Retorna a visualização 'budget.show' passando as variáveis $data_users
        return view('budget.show', compact('data_user'));
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
    public function update(Request $request, string $id, $register)
    {
        $data = $request->validated();
        dd($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sendBudget($id)
    {
        try {
            // Chame a sua Service para enviar o orçamento
            $this->budgetService->sendBuget($id);

            // Defina a mensagem de sucesso na sessão
            Session::flash('success', 'Orçamento enviado com sucesso.');
        } catch (\Exception $e) {
            // Em caso de erro, defina a mensagem de erro na sessão
            Session::flash('error', 'Ocorreu um erro ao enviar o orçamento: ' . $e->getMessage());
        }

        // Redirecione para a mesma tela
        return redirect()->back();
    }
}
