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
            'platform' => 'string',
            'browser_support' => 'string',
            'operational_system' => 'string',


            'value_per_page' => 'required|numeric',
            'value_page_login' => 'integer',

            'system_pay' => 'boolean',
            'printer' => 'integer',
            'license_access' => 'integer',

            'value' => [
                'required', 'integer', Rule::exists('user_project_budgets', 'id')
            ],

        ];
    }
}
