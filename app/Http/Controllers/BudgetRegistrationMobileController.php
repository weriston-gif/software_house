<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetTypeRequest;
use App\Models\Type;
use App\Models\UserProjectBudget;
use App\Models\UserProjectBudgetType;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class BudgetRegistrationMobileController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    private function getRequestValues(CreateBudgetTypeRequest $request)
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
        $platform = $platform ?? '0';
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
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $supportsName = Type::arraySupportsName();

        return view('budget.budget-mobile')
            ->with('supportsName', $supportsName);
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

            dd($valuePageLogin);
            // Calcule o valor total usando o serviço 'BudgetService'
            $totalValue = $this->budgetService->calculateTotalValue($valuePerPage, $valuePageLogin, $type);
            // Registre os dados na tabela 'user_project_budget_types' usando o serviço 'BudgetService'
            $data_mobile = [
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


            $register = $this->budgetService->registerBudget($data_mobile);

            // Verifique se o registro foi bem-sucedido antes de redirecionar
            if ($register) {
                // Redirecione para a action 'show' com o ID do orçamento
                return redirect()->route('budget.show', [
                    'cadastro_orcamento' => $idValidate,
                    'register' => $register,
                ])->with('success', 'Envio bem-sucedido. Orçamento registrado com sucesso.');
            } else {
                // Retorne para a mesma tela com uma mensagem de erro
                return redirect()->back()->with('error', 'Erro no registro do orçamento.');
            }
        } catch (\Exception $exception) {
            // Retorne para a mesma tela com uma mensagem de erro
            return redirect()->back()->with('error', 'Erro no envio: ' . $exception->getMessage());
        }
    }
}
