<x-guest-layout>
    @section('title', 'Informações de orçamento')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <a href="{{route('cadastro-orcamento.index')}}" class="px-5 py-2.5 text-sm font-semibold leading-6 text-primary-900 shadow-sm hover:bg-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Voltar</a>
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
        </div>
        <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 200px;">
            <div class="mt-auto p-2 bd-highlight">


                <form action="{{ route('enviar-orcamento', ['id' => $user['user_project_budget']['id']]) }}" method="POST">
                    @csrf
                    <button type="submit">Enviar Orçamento</button>
                </form>

            </div>
        </div>
        @endforeach


</x-guest-layout>