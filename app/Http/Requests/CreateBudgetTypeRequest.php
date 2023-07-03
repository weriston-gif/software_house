<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBudgetTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'value' => [
                'required', 'integer',  Rule::exists('user_project_budget_types', 'id')
            ], // validação básica para o ID
            'value_per_page' => [
                'required',
                'integer',
            ],
            'value_page_login' => [
                'boolean'
            ],
            'system_pay' => [
                'boolean'
            ],
            'platform' => [
                'string'
            ]


        ];
    }
}
