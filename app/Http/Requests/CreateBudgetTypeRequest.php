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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'platform' => 'string',
            'browser_support' => 'string',
            'type_id' => 'string|numeric',
            'operational_system' => 'string',
            'value_total_page' => 'required|numeric',
            'page_login' => 'boolean',
            'system_pay' => 'boolean',
            'printer' => 'boolean',
            'license_access' => 'boolean',
            'user_project_budget_id' => [
                'required', 'string', Rule::exists('user_project_budgets', 'id'),
            ],

        ];
    }
}
