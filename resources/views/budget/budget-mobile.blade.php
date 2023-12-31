<x-guest-layout>
    @section('title', 'Orçamento de Mobile.')
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
    <div class="container d-flex justify-content-center mt-5">
        <form class="w-full" action="{{ route('cadastro-orcamento-tipo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="platform" class="block">Qual plataforma:</label>
                    <input type="text" name="platform" id="platform" placeholder="Quais plataforma" class="w-full rounded-md p-2 border border-gray-300">
                    @error('platform')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="value_total_page" class="block">Quantas telas: </label>
                    <input type="number" name="value_total_page" id="value_total_page" value="{{ old('value_total_page') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('value_total_page')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="page_login" class="block">Terá tela de login: </label>
                    <input type="hidden" name="page_login" value="0">
                    <input type="checkbox" name="page_login" value="1" id="page_login">
                    @error('page_login')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="system_pay" class="block">Terá tela de pagamento: </label>
                    <input type="hidden" name="system_pay" value="0">
                    <input type="checkbox" name="system_pay" value="1" id="system_pay">
                    @error('system_pay')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" id="user_project_budget_id" name="user_project_budget_id">
            <input type="hidden" id="type_id" name="type_id" value="2">

            <div class="flex justify-end mt-3">
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Cadastrar-se</button>
            </div>
        </form>
    </div>

    <script>
        // Obtém o valor da sessionStorage
        var id = sessionStorage.getItem('id');
        // Define o valor do input hidden
        document.getElementById('user_project_budget_id').value = id;
    </script>
</x-guest-layout>