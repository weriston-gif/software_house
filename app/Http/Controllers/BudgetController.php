<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetRequest;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserProjectBudget;
use Illuminate\Contracts\View\View;

class BudgetController extends Controller
{
    public function index()
    {
        $empresa = User::findOrFail(1);

        $type = Type::getAllTypes();
       dd($empresa);
        
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
