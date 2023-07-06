<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
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

    public function indexDesktop(): View
    {

        return view('budget.budget-desktop');
    }

    public function indexMobile(): View
    {
        return view('budget.budget-mobile');
    }

    public function indexWeb(): View
    {

        return view('budget.budget-web');
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
                'success' => 'Dados criados com sucesso. Envie o orçamento para o e-mail: '.$request->email,
                'budgetId' => $budget->id,
            ]);
        } catch (Throwable $e) {
            Log::error('Erro ao criar o budget:', ['exception' => $e]);

            return redirect()->back()->with('error', 'Erro ao criar o budget: '.$e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function sendBudget($id)
    {
        try {
            // Chame a sua Service para enviar o orçamento
            $user = UserProjectBudget::findOrFail($id);

            $this->budgetService->sendBuget($user->email);

            // Defina a mensagem de sucesso na sessão
            Session::flash('success', 'Orçamento enviado com sucesso.');
        } catch (\Exception $e) {
            // Em caso de erro, defina a mensagem de erro na sessão
            Log::error('Ocorreu um erro ao enviar o orçamento:', ['exception' => $e]);
            Session::flash('error', 'Ocorreu um erro ao enviar o orçamento: '.$e->getMessage());
        }

        // Redirecione para a mesma tela
        return redirect()->back();
    }
}
