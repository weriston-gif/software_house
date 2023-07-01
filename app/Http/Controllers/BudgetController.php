<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\UserProjectBudget;
use Illuminate\Contracts\View\View;

class BudgetController extends Controller
{
    public function index()
    {
        $type = Type::getAllTypes();
        
        return view('budget.index', compact('type'));
    }

    public function create()
    {
        return view('budget.create');
    }

    public function store(CreateBudgetRequest $request)
    {
        // Os dados já foram validados pelo form request

        // Criação de um novo registro de budget
        UserProjectBudget::create($request->validated());

        return redirect()->route('budget.index')->with('success', 'Budget criado com sucesso.');
    }
}
