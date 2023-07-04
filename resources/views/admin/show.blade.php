<x-app-layout>
    @section('title', 'Dados do usuário')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <p class="h2">Dados pessoais</p>
                            @foreach ($data_user as $user)
                            <div class="col-3">
                                <p style="color: #0d6efd;">Nome:</p>
                                {{ $user['user_project_budget']['name'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">E-Mail:</p>

                                {{ $user['user_project_budget']['email'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Telefone:</p>

                                {{ $user['user_project_budget']['telefone'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Rua:</p>

                                {{ $user['user_project_budget']['rua'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Número:</p>

                                {{ $user['user_project_budget']['numero'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Bairro:</p>

                                {{ $user['user_project_budget']['bairro'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">CEP:</p>

                                {{ $user['user_project_budget']['cep'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Complemento:</p>

                                {{ $user['user_project_budget']['complemento'] ?? '' }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Municipio:</p>

                                {{ $user['user_project_budget']['municipio'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">UF:</p>

                                {{ $user['user_project_budget']['uf'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">PAIS:</p>

                                {{ $user['user_project_budget']['pais'] }}
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <p class="h2">Dados Tipo</p>

                            @foreach ($data_user as $type)
                            <div class="col-3">
                                <p style="color: #0d6efd;">Descrição do Tipo:</p>

                                {{ $type['type']['description'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Valor página de login em reais:</p>

                                {{ $type['type']['value_page_login'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Valor por página em reais:</p>

                                {{ $type['type']['value_per_page'] }}
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <p class="h2">Dados Orçamentos</p>

                            @foreach ($data_user as $budget)
                            <div class="col-3">
                                <p style="color: #0d6efd;">Sistema Operacional:</p>

                                {{ $budget['operational_system'] == 0 ? 'Não' : budget['operational_system'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Valor total de página:</p>

                                {{ $budget['value_total_page'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Browser Suporta:</p>

                                {{ $budget['browser_support'] == 0 ? 'Não' :  $budget['browser_support']  }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Plataforma suporta:</p>

                                {{ $budget['platform'] == 0 ? 'Não' : $budget['platform'] }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Impressora:</p>

                                {{ empty($budget['printer'])  ? 'Não' : 'Sim'  }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Licença de acesso:</p>

                                {{ empty($budget['license_access']) ? 'Não' : 'Sim'  }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Licença de acesso:</p>

                                {{ empty($budget['license_access']) ? 'Não' : 'Sim'  }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Sistema de pagamento:</p>

                                {{ empty($budget['system_pay']) ? 'Não' : 'Sim'  }}
                            </div>
                            <div class="col-3">
                                <p style="color: #0d6efd;">Página de login:</p>

                                {{ empty($budget['page_login']) ? 'Não' : 'Sim'  }}
                            </div>
                            <div class="col-3 ">
                                <p style="color: #0d6efd;" class="bg-success-subtle">Valor do ORÇAMENTO EM REAIS:</p>

                                {{ $budget['final_budget_value'] }}
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>