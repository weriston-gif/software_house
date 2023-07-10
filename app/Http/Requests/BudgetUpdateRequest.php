<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BudgetUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'user_project_budget_id' => [
                'required', 'string', Rule::exists('user_project_budgets', 'id'),
            ],
            'user_project_budget_type_id' => [
                'required', 'string',
            ],
            'type_id' => [
                'required', 'string',
            ],
            'name' => 'required|string',
            'email' => 'required|email',
            'telefone' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'complemento' => 'nullable',
            'municipio' => 'required',
            'uf' => 'required',
            'pais' => 'required',

            'value_total_page' => 'required|string',

            'page_login' => 'boolean',
            'system_pay' => 'boolean',
            'printer' => 'boolean',
            'license_access' => 'boolean',
    

        ];
    }
}
