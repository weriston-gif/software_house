<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminservice;

    public function __construct(AdminService $adminservice)
    {
        $this->adminservice = $adminservice;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_users = $this->adminservice->getFilteredBudgetForAdmin();

        return view('admin.index')
            ->with('data_users', $data_users);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_user = $this->adminservice->getFilteredBudgetForAdminParams($id);

        return view('admin.show')
            ->with('data_user', $data_user);

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
