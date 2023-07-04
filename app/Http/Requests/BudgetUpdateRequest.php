<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BudgetUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'valuePerPage' => 'required|numeric',
            'browser_support' => 'required_if:type,1|string',
            'platform' => 'required_if:type,2|string',
            'operational_system' => 'required_if:type,3|string',
            'printer' => 'boolean',
            'license_access' => 'boolean',
            'system_pay' => 'boolean',
            'final_budget_value' => 'numeric',
            'value' => 'required', Rule::exists('user_project_budgets', 'id'),
        ];
    }
}
