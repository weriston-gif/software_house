<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetUpdateRequest;
use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BudgetRegistrationTypeController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    private function getRequestValues(Request $request)
    {
        $valuePerPage = $request->input('value_per_page');
        $valuePageLogin = $request->input('value_page_login');
        $browserSupport = $request->input('browser_support');
        $operationalSystem = $request->input('operational_system');
        $printer = $request->input('printer');
        $licenseAccess = $request->input('license_access');
        $systemPay = $request->input('system_pay');
        $user_project_budget_id = $request->input('value');
        $platform = $request->input('platform');
        $type = $request->input('type');

        $browserSupport = $browserSupport ?? '0';
        $valuePageLogin = $valuePageLogin ?? '0';
        $platform = $platform ?? '0';
        $systemPay = $systemPay ?? '0';
        $operationalSystem = $operationalSystem ?? '0';
        $valuePerPage = $valuePerPage ?? 0;
        $printer = $printer ?? false;
        $licenseAccess = $licenseAccess ?? false;

        return [
            'valuePerPage' => $valuePerPage,
            'valuePageLogin' => $valuePageLogin,
            'browserSupport' => $browserSupport,
            'operationalSystem' => $operationalSystem,
            'printer' => $printer,
            'licenseAccess' => $licenseAccess,
            'systemPay' => $systemPay,
            'idValidate' => $user_project_budget_id,
            'platform' => $platform,
            'type' => $type,
        ];
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBudgetTypeRequest $request)
    {

        try {
            // Obtenha os valores do request
            $values = $this->getRequestValues($request);

            $valuePerPage = $values['valuePerPage'];
            $valuePageLogin = $values['valuePageLogin'];
            $browserSupport = $values['browserSupport'];
            $operationalSystem = $values['operationalSystem'];
            $printer = $values['printer'];
            $licenseAccess = $values['licenseAccess'];
            $systemPay = $values['systemPay'];
            $idValidate = $values['idValidate'];
            $platform = $values['platform'];
            $type = $values['type'];

            // Calcule o valor total usando o serviço 'BudgetService'
            $totalValue = $this->budgetService->calculateTotalValue($valuePerPage, $valuePageLogin, $type);
            // Registre os dados na tabela 'user_project_budget_types' usando o serviço 'BudgetService'
            $data_register = [
                'user_project_budget_id' => $idValidate,
                'valuePerPage' => $valuePerPage,
                'type_id' => $type,
                'platform' => $platform,
                'value_page_login' => $valuePageLogin,
                'system_pay' => $systemPay,
                'final_budget_value' => $totalValue,
                'license_access' => $licenseAccess,
                'printer' => $printer,
                'operational_system' => $operationalSystem,
                'browser_support' => $browserSupport,
            ];

            $register = $this->budgetService->registerBudget($data_register);

            // Verifique se o registro foi bem-sucedido antes de redirecionar
            if ($register) {
                // Redirecione para a action 'show' com o ID do orçamento
                return redirect()->route('cadastro-orcamento-tipo.edit', [
                    'cadastro_orcamento_tipo' => $register,
                ])->with('success', 'Envio bem-sucedido. Orçamento registrado com sucesso gostaria de editar.');
            } else {
                // Retorne para a mesma tela com uma mensagem de erro
                return redirect()->back()->with('error', 'Erro no registro do orçamento.');
            }
        } catch (\Exception $exception) {
            // Retorne para a mesma tela com uma mensagem de erro
            Log::error('Erro no registro do orçamento:', ['exception' => $exception]);

            return redirect()->back()->with('error', 'Erro no envio: ' . $exception->getMessage());
        }
    }



    public function edit(string $cadastro_orcamento_tipo): View
    {
        $data_user = $this->budgetService->getFilteredBudgetForUser($cadastro_orcamento_tipo);

        if (!$data_user) {
            abort(404, 'Registro não encontrado.');
        }
        $types = Type::arrayTypes();

        // Retorna a visualização 'budget.show' passando as variáveis $data_users
        return view('budget.edit', compact('data_user', 'types'));
    }

    public function update(BudgetUpdateRequest $request)
    {
        try {

            $data_user = $request->validated();
            $values = $this->getRequestValues($request);


            $valuePerPage = $values['valuePerPage'];
            $valuePageLogin = $values['valuePageLogin'];
            $browserSupport = $values['browserSupport'];
            $operationalSystem = $values['operationalSystem'];
            $printer = $values['printer'];
            $licenseAccess = $values['licenseAccess'];
            $systemPay = $values['systemPay'];
            $platform = $values['platform'];
            $type = $values['type'];

            $data_user_persona = [
                'name' => $data_user['name'],
                'email' => $data_user['email'],
                'telefone' => $data_user['telefone'],
                'cep' => $data_user['cep'],
                'rua' => $data_user['rua'],
                'numero' => $data_user['numero'],
                'bairro' => $data_user['bairro'],
                'complemento' => $data_user['complemento'],
                'municipio' => $data_user['municipio'],
                'uf' => $data_user['uf'],
                'pais' => $data_user['pais'],

            ];

            $totalValue = $this->budgetService->calculateTotalValue($valuePerPage, $valuePageLogin, $type);
            $data_user_types = [
                'final_budget_value' => $totalValue,
                'valuePerPage' => $valuePerPage,
                'type_id' => $type,
                'platform' => $platform,
                'value_page_login' => $valuePageLogin,
                'system_pay' => $systemPay,
                'license_access' => $licenseAccess,
                'printer' => $printer,
                'operational_system' => $operationalSystem,
                'browser_support' => $browserSupport,
            ];

            $register = $this->budgetService->updateBudgetForUser($data_user['id'], $data_user['idBudget'], $data_user_persona, $data_user_types);
            
            dd($register);
            // Lógica de atualização aqui

            // Retornar uma resposta de sucesso, redirecionar ou fazer qualquer outra coisa necessária
        } catch (\Exception $e) {
            // Capturar a exceção e lidar com ela adequadamente
            // Por exemplo, você pode registrar a exceção, exibir uma mensagem de erro, redirecionar para uma página de erro, etc.

            // Exemplo de registro de exceção:
            Log::error('Erro durante a atualização do orçamento:', ['exception' => $e]);

            // Exemplo de redirecionamento para uma página de erro com mensagem de erro
            return redirect()->back()->with('error', 'Erro no envio: ' . $e->getMessage());
        }
    }
}
