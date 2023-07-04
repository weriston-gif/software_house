<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserProjectBudgetType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Notifications\NewBudget;

class BudgetService
{
    public function calculateTotalValue(int $valuePerPage, int $valuePageLogin, $type): float
    {
        try {
            $typeModel = Type::findOrFail($type);
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('Tipo de valor da página de login não encontrado.', 404, $exception);
        }

        $valuePerPage = $typeModel->value_per_page;
        $valuePageLogin = !empty($valuePageLogin) ? $valuePerPage : 0;

        $totalValue = ($valuePerPage * $valuePerPage) + $valuePageLogin;

        // Retorne a mensagem de sucesso
        return $totalValue;
    }
    public function getFilteredBudgetForUser($id)
    {
        try {
            $filteredBudget = UserProjectBudgetType::with('userProjectBudget', 'type')
                ->where('id', $id)
                ->get()
                ->map(function ($budget) {
                    $filteredBudgetArray = $budget->toArray();

                    unset($filteredBudgetArray['created_at']);
                    unset($filteredBudgetArray['updated_at']);

                    return $filteredBudgetArray;
                });

            return $filteredBudget->toArray();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao obter os orçamentos com ID ' . $id . ': ' . $e->getMessage());
        }
    }

    public function registerBudget(array $data)
    {
        // Definir as regras de validação para cada campo
        $rules = [
            'user_project_budget_id' => 'required',
            'type_id' => 'required|exists:types,id',
            'valuePerPage' => 'integer|required',
            'platform' => 'string',
            'browser_support' => 'string',
            'operational_system' => 'string',
            'value_page_login' => 'integer|string',
            'system_pay' => 'integer',
            'printer' => 'boolean',
            'license_access' => 'boolean',
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
        $validator = validator($data, $rules, $messages);

        // Verificar se houve erros de validação
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        // Criar um novo registro na tabela user_project_budget_types
        $budgetType = UserProjectBudgetType::create([
            'user_project_budget_id' => $data['user_project_budget_id'],
            'type_id' => $data['type_id'],
            'value_total_page' => $data['valuePerPage'],
            'platform' => $data['platform'] ?? 0,
            'browser_support' => $data['browser_support'] ?? 0,
            'operational_system' => $data['operational_system'] ?? 0,
            'system_pay' => isset($data['system_pay']) && $data['system_pay'] === '1',
            'page_login' => isset($data['value_page_login']) && $data['value_page_login'] === '1',
            'printer' => isset($data['printer']) && $data['printer'] === '1',
            'license_access' => isset($data['license_access']) && $data['license_access'] === '1',
            'final_budget_value' => $data['final_budget_value'],
        ]);

        return $budgetType->id;
    }

    public function sendBuget($id)
    {
        $user = UserProjectBudget::findOrFail($id);
        Notification::route('mail', $user->email)
            ->notify(new NewBudget());

        return true;
    }
}
