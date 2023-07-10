<?php

namespace App\Services;

use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Notifications\NewBudget;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BudgetService
{
    public function calculateTotalValue(int $valuePerPage, int $valuePageLogin, $type): float
    {
        try {
            $typeModel = Type::findOrFail($type);
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('Tipo de valor da página de login não encontrado.', 404, $exception);
        }

        $valuePerPage_in_bd = $typeModel->value_per_page;
        $valuePerPage_login_in_bd = $typeModel->value_page_login;

        $valuePageLogin = !empty($valuePageLogin) ? $valuePerPage_login_in_bd : 0;

        $totalValue = ($valuePerPage_in_bd * $valuePerPage) + $valuePageLogin;

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

    public function updateBudgetForUserType($idUserProject, $idUserProjectType, array $dataUserPersona, array $dataUserTypes)
    {

        try {
            DB::beginTransaction();

            $budgetUser = UserProjectBudget::findOrFail($idUserProject);
            $budgetUserType = UserProjectBudgetType::findOrFail($idUserProjectType);

            $budgetUser->fill($dataUserPersona);
            $budgetUser->save();

            $budgetUserType->fill($dataUserTypes);
            $budgetUserType->save();

            Notification::route('mail', $budgetUser->emai)
                ->notify(new NewBudget());

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao atualizar o orçamento com ID ' . $idUserProject . ': ' . $e->getMessage());
        }
    }

    public function registerBudget(array $data)
    {
        try {
            $budgetType = UserProjectBudgetType::create($data);
    
            return $budgetType->id;
        } catch (\Exception $e) {
            // Tratamento da exceção
            // Por exemplo, você pode registrar o erro, exibir uma mensagem de erro, etc.
            Log::error('Erro ao registrar o orçamento: ' . $e->getMessage());

            // Lançar a exceção novamente se desejar propagá-la para camadas superiores
            throw new \Exception('Erro ao registrar o orçamento:  ' . $e->getMessage());
        }
    }
    
    //metodo de envio de e-mail
    public function sendBuget($email)
    {
        Notification::route('mail', $email)
            ->notify(new NewBudget());

        return true;
    }
}
