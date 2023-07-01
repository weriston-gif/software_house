<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEmail;
use Illuminate\Validation\Rule;

class CreateBudgetRequest extends FormRequest
{
    public function authorize()
    {
        return False;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:255'
            ],
            'email' => [
                'email', 'max:255',
                Rule::unique('user_project_budget', 'email'),
                'required'
            ],
            'telefone' => [
                'string', 'max:50',
            ],
            'rua' => [
                'string', 'max:100',
                'required'

            ],
            'bairro' => [
                'string', 'max:50',
                'required'
            ],
            'numero' => [
                'string', 'max:50',
                'required'
            ],
            'cep' => [
                'string', 'max:20',
                'required'
            ],
            'complemento' => [
                'string', 'max:100',
                'nullable'
            ],
            'municipio' => [
                'string', 'max:100',
                'required'
            ],
            'uf' => [
                'string', 'max:50',
                'required'
            ],
            'pais' => [
                'string', 'max:50',
                'required'
            ],



        ];
    }
}
