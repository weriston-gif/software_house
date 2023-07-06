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
        <form class="w-full" action="{{ route('cadastro-orcamento-tipo.update', ['cadastro_orcamento_tipo' => 1]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PATCH')
            <div class="row">
                <p class="h2">Dados pessoais</p>
                @foreach ($data_user as $user)
                <div class="col-3">

                    <label for="name" class="block">Nome:</label>
                    <input type="text" value="{{ $user['user_project_budget']['name'] }}" name="name" id="name" class="w-full rounded-md p-2 border border-gray-300">

                </div>
                <div class="col-3">
                    <label for="email" class="block">E-mail:</label>
                    <input type="email" value=" {{ $user['user_project_budget']['email'] }}" name="email" id="email" class="w-full rounded-md p-2 border border-gray-300">


                </div>
                <div class="col-3">
                    <label for="telefone" class="block">Telefone:</label>
                    <input type="text" name="telefone" value="{{ $user['user_project_budget']['telefone'] }}" id="telefone" class="w-full rounded-md p-2 border border-gray-300" placeholder="+55 9999-9999">
                    @error('telefone')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="cep" class="block">CEP:</label>
                    <input type="text" name="cep" id="cep" value="{{ $user['user_project_budget']['cep'] }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('cep')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="rua" class="block">Rua:</label>
                    <input type="text" name="rua" id="rua" value="{{ $user['user_project_budget']['rua'] }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('rua')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="numero" class="block">Número:</label>
                    <input type="text" name="numero" id="numero" value="{{ $user['user_project_budget']['numero'] }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('numero')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="bairro" class="block">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" value="{{ $user['user_project_budget']['bairro'] }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('bairro')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="complemento" class="block">Complemento:</label>
                    <input type="text" name="complemento" id="complemento" value="{{ $user['user_project_budget']['complemento'] ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('complemento')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="municipio" class="block">Município:</label>
                    <input type="text" name="municipio" id="municipio" value="{{ $user['user_project_budget']['municipio'] }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('municipio')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-3">
                    <label for="uf" class="block">UF:</label>
                    <input type="text" name="uf" id="uf" value="{{ $user['user_project_budget']['uf'] }}" class="w-100 rounded-md p-2 border border-gray-300">
                    @error('uf')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="pais" class="block">País:</label>
                    <input type="text" name="pais" id="pais" value="{{ $user['user_project_budget']['pais'] }}" class="w-100 rounded-md p-2 border border-gray-300">
                    @error('pais')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>

            </div>
            <div class="row">
                <p class="h2">Dados Tipo</p>
                <select id="tipoSelect">
                    @foreach ($types as $key => $value)
                    <option value="{{ $key }}" {{ ($user['type']['id'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <p class="h2">Dados Orçamentos</p>


                <div class="col-3 desktopElement ">
                    <label for="operational_system" class="block">Qual sistema operacional:</label>
                    <input value=" {{ $user['operational_system'] == 0 ? '' :  $user['operational_system']  }}" type="text" name="operational_system" id="operational_system" placeholder="Quais sistema operacionais...">
                    @error('operational_system')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-3 webElement">
                    <label for="browser_support" class="block">Qual browser:</label>
                    <input value="{{ $user['browser_support'] == 0 ? '' :  $user['browser_support']  }}" type="text" name="browser_support" id="browser_support" placeholder="Quais browser">
                    @error('browser_support')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-3  mobileElement">
                    <label for="platform" class="block">Qual plataforma:</label>
                    <input value=" {{ $user['platform'] == 0 ? '' : $user['platform'] }}" type="text" name="platform" id="platform" placeholder="Quais plataformas...">
                    @error('platform')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-3">
                    <label for="value_per_page" class="block">Quantas telas: </label>
                    <input type="text" name="value_per_page" id="value_per_page" value=" {{ $user['value_total_page'] }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('value_per_page')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3  desktopElement">
                    <label for="printer" class="block">Impressora: </label>
                    <input type="hidden" name="printer" value="0">
                    <input type="checkbox" name="printer" value="1" id="printer" {{ (!empty($user['printer']) && $user['printer']) ? 'checked' : '' }}>
                    @error('printer')

                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3  genericElement">
                    <label for="value_page_login" class="block">Terá tela de login: </label>
                    <input type="hidden" name="value_page_login" value="0">
                    <input type="checkbox" name="value_page_login" value="1" id="value_page_login" {{ (!empty($user['page_login']) && $user['page_login']) ? 'checked' : '' }}>
                    @error('value_page_login')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3  desktopElement">
                    <label for="license_access" class="block">Terá licença: </label>
                    <input type="hidden" name="license_access" value="0">
                    <input type="checkbox" name="license_access" value="1" id="license_access" {{ (!empty($user['license_access']) && $user['license_access']) ? 'checked' : '' }}>
                    @error('license_access')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3 genericElement2">
                    <label for="system_pay" class="block">Terá tela de pagamento: </label>
                    <input type="hidden" name="system_pay" value="0">
                    <input type="checkbox" name="system_pay" value="1" id="system_pay" {{ (!empty($user['system_pay']) && $user['system_pay']) ? 'checked' : '' }}>
                    @error('system_pay')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-3 ">
                    <p style="color: #0d6efd;" class="bg-success-subtle">Valor do ORÇAMENTO atual:</p>

                    R$ {{ $user['final_budget_value'] }}
                </div>
            </div>

            <input type="hidden" id="idBudget" name="idBudget" value="{{ $user['id'] }}">
            <input type="hidden" id="id" name="id" value="{{ $user['user_project_budget']['id']}}">
            <input type="hidden" id="type" name="type" value="">

            <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 200px;">
                <div class="mt-auto p-2 bd-highlight">


                    <form action="{{ route('cadastro-orcamento-tipo.update', ['cadastro_orcamento_tipo' => $user['user_project_budget']['id']]) }}" method="POST">
                        @csrf
                        <button type="submit">Confirmar o envio do Orçamento </button>
                    </form>

                </div>
            </div>
        </form>

        @endforeach
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtenha o elemento select pelo ID
            const tipoSelect = document.getElementById('tipoSelect');
            const selectedValue = tipoSelect.value;
            document.getElementById('type').value = selectedValue;

            // Obtenha os elementos que devem ser exibidos ou ocultados
            const webElements = document.querySelectorAll('.webElement');
            const mobileElements = document.querySelectorAll('.mobileElement');
            const desktopElements = document.querySelectorAll('.desktopElement');
            const genericElement = document.querySelector('.genericElement');
            const genericElement2 = document.querySelector('.genericElement2');

            const browser_support = document.getElementById('browser_support');
            const operational_system = document.getElementById('operational_system');
            const platform = document.getElementById('platform');
            const printer = document.getElementById('printer');
            const value_page_login = document.getElementById('value_page_login');
            const license_access = document.getElementById('license_access');
            const system_pay = document.getElementById('system_pay');



            // Defina uma função para manipular a mudança no select
            function handleTipoSelectChange() {
                // Obtenha o valor selecionado
                const selectedValue = tipoSelect.value;
                document.getElementById('type').value = selectedValue;

                // Exiba ou oculte elementos com base no valor selecionado
                if (selectedValue === '1') {
                    // Exibir elementos da Web e ocultar elementos móveis, desktop e genérico
                    webElements.forEach(function(element) {
                        element.style.display = 'block';
                    });
                    mobileElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    desktopElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    genericElement2.style.display = 'block';

                    genericElement.style.display = 'block';
                    operational_system.value = '';
                    platform.value = '';
                    printer.checked = false;
                    license_access.checked = false;

                } else if (selectedValue === '2') {
                    // Exibir elementos móveis e ocultar elementos da Web, desktop e genérico
                    webElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    mobileElements.forEach(function(element) {
                        element.style.display = 'block';
                    });
                    desktopElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    genericElement2.style.display = 'block';

                    operational_system.value = '';
                    browser_support.value = '';
                    printer.checked = false;
                    license_access.checked = false;

                    genericElement.style.display = 'block';
                } else if (selectedValue === '3') {
                    // Ocultar elementos da Web, móveis e genérico, e exibir elementos desktop
                    genericElement.style.display = 'none';
                    genericElement2.style.display = 'none';


                    webElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    mobileElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    desktopElements.forEach(function(element) {
                        element.style.display = 'block';
                    });

                    browser_support.value = '';
                    platform.value = '';
                    value_page_login.checked = false;
                    system_pay.checked = false;
                }
            }

            // Verifique se o elemento select existe antes de atribuir o evento de mudança
            if (tipoSelect) {
                // Atribua o evento de mudança ao select
                tipoSelect.addEventListener('change', handleTipoSelectChange);

                // Execute a função inicialmente para lidar com o valor selecionado ao carregar a página
                handleTipoSelectChange();
            }
        });
    </script>

</x-guest-layout>