<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserProjectBudgetType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Collection;
use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Notifications\NewBudget;

class BudgetService
{
    public function calculateTotalValueMobile(int $valuePerPage, int $value_page_login): float
    {
        try {
            $type = Type::findOrFail(1);
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('Tipo de valor da página de login não encontrado.', 404, $exception);
        }

        $value_per_page = $type->value_per_page;
        $value_page_login = $value_page_login === 1 ? $value_per_page : 0;

        $sum = ($valuePerPage * $value_per_page) + $value_page_login;
        return $sum;
    }

    public function registerBudget(array $data)
    {
        // Definir as regras de validação para cada campo
        $rules = [
            'user_project_budget_id' => 'required',
            'type_id' => 'required|exists:types,id',
            'platform' => 'integer|string',
            'browser_support' => 'integer|string',
            'operational_system' => 'integer|string',
            'value_page_login' => 'integer|string',
            'system_pay' => 'integer|string',
            'printer' => 'integer|string',
            'license_access' => 'integer|string',
            'final_budget_value' => 'required|numeric',
        ];

        // Definir as mensagens de erro personalizadas
        $messages = [
            'user_project_budget_id.required' => 'O campo "ID do projeto" é obrigatório.',
            'user_project_budget_id.exists' => 'O ID do projeto não foi encontrado.',
            'type_id.required' => 'O campo "ID do tipo" é obrigatório.',
            'type_id.exists' => 'O ID do tipo não foi encontrado.',
            'platform.required' => 'O campo "Plataforma" é obrigatório.',
            'final_budget_value.required' => 'O campo "Valor final do orçamento" é obrigatório.',
            'final_budget_value.numeric' => 'O campo "Valor final do orçamento" deve ser um número.',
        ];

        // Realizar a validação dos campos
        $validator = Validator::make($data, $rules, $messages);

        // Verificar se houve erros de validação
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        // Criar um novo registro na tabela user_project_budget_types
        $budgetType = new UserProjectBudgetType();
        $budgetType->user_project_budget_id = $data['user_project_budget_id'];
        $budgetType->type_id = $data['type_id'];

        // Usar o operador de coalescência nula (null coalescing operator) para definir os valores padrão
        $budgetType->platform = $data['platform'] ?? 0;
        $budgetType->browser_support = $data['browser_support'] ?? 0;
        $budgetType->operational_system = $data['operational_system'] ?? 0;

        // Usar o operador ternário para definir valores booleanos com base nos dados fornecidos
        $budgetType->system_pay = isset($data['system_pay']) && $data['system_pay'] === '1';
        $budgetType->printer = isset($data['printer']) && $data['printer'] === '1';
        $budgetType->license_access = isset($data['license_access']) && $data['license_access'] === '1';

        $budgetType->final_budget_value = $data['final_budget_value'];

        // Salvar o novo registro no banco de dados
        $budgetType->save();
        // Obter o ID do novo cadastro
        $budgetTypeId = $budgetType->id;

        return $budgetTypeId;
    }

    public function sendBuget($id)
    {
        $user = UserProjectBudget::findOrFail($id);
        Notification::route('mail', $user->email)
            ->notify(new NewBudget());

        dd($user);

        return true;
    }
}
