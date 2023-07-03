<x-guest-layout>

    <div class="container d-flex justify-content-center mt-5">
        <form method="POST" action="{{ route('cadastro-orcamento-mobile.store') }}">
            @csrf

            <div class="row">
                @foreach ($budgetValues as $budgetValue)
                <div class="col-6">
                    <label for="name" class="block">Nome:</label>
                    <input disabled type="text" name="name" id="name" value="{{ $budgetValue->name ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-6">
                    <label for="email" class="block">E-mail:</label>
                    <input disabled type="email" name="email" id="email" value="{{ $budgetValue->{'email'} ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-6">
                    <label for="telefone" class="block">Telefone:</label>
                    <input disabled type="text" name="telefone" id="telefone" value="{{ $budgetValue->telefone ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-6">
                    <label for="browser_support" class="block">Suporta browser:</label>
                    <input disabled type="text" name="browser_support" id="browser_support" value="{{ $budgetValue->{'suport_browser'} ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-6">
                    <label for="platform" class="block">Plataforma:</label>
                    <input disabled type="text" name="platform" id="platform" value="{{ $budgetValue->platform ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-6">
                    <label for="operational_system" class="block">Sistema Operacional:</label>
                    <input disabled type="text" name="operational_system" id="operational_system" value="{{ $budgetValue->{'sistema_operacional'} ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-3">
                    <label for="printer" class="block">Impressora   :</label>
                    <input disabled type="checkbox" name="printer" id="printer" value="{{ $budgetValue->printer ?? '' }}">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-3">
                    <label for="license_access" class="block">Licença de acesso:</label>
                    <input disabled type="checkbox" name="license_access" id="license_access" value="{{ $budgetValue->{'license_access'} ?? '' }}">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-3">
                    <label for="system_pay" class="block">S de pagamento:</label>
                    <input disabled type="checkbox" name="system_pay" id="system_pay" value="{{ $budgetValue->{'system_pay'} ?? '' }}">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                <div class="col-12">
                    <label for="final_budget_value" class="block">Valor final:</label>
                    <input disabled type="text" name="final_budget_value" id="final_budget_value" value="R$ {{ $budgetValue->{'final_budget_value'} ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    <!-- Mostrar mensagem de erro se houver -->
                </div>
                @endforeach
            </div>

            <button type="submit">Enviar</button>
        </form>

    </div>

</x-guest-layout>