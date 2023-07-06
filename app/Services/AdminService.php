<?php

namespace App\Services;

use App\Models\UserProjectBudgetType;

class AdminService
{
    public function getFilteredBudgetForAdmin()
    {
        try {
            // Obter todos os orçamentos de projeto de usuário com as relações
            $budgets = UserProjectBudgetType::with('userProjectBudget', 'type')->get();

            // Filtrar os orçamentos removendo as chaves 'created_at' e 'updated_at'
            $filteredBudgets = $budgets->map(function ($budget) {
                $filteredBudget = $budget->toArray();
                unset($filteredBudget['created_at']);
                unset($filteredBudget['updated_at']);

                return $filteredBudget;
            });

            // Retornar os orçamentos filtrados como um array
            return $filteredBudgets->toArray();
        } catch (\Exception $e) {
            // Lidar com exceção, se ocorrer algum erro durante o processo
            throw new \Exception('Erro ao obter os orçamentos: '.$e->getMessage());
        }
    }

    public function getFilteredBudgetForAdminParams($id)
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
            throw new \Exception('Erro ao obter os orçamentos com ID '.$id.': '.$e->getMessage());
        }
    }
}
