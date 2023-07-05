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
            'id' => [
                'required', 'integer', Rule::exists('user_project_budgets', 'id'),
            ],
            'idBudget' => [
                'required', 'integer', 
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
            
        ];
    }
}
