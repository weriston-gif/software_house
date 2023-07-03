<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BudgetRegistrationMobileController extends Controller
{
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
        $data = $request->validated();
        dd($data);
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
