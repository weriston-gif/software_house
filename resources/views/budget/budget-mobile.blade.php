<x-guest-layout>
@section('title', 'Orçamento de Mobile.')

    <div class="container d-flex justify-content-center mt-5">
        <form class="w-full" action="{{ route('cadastro-orcamento-mobile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="platform" class="block">Qual plataforma:</label>
                    <select name="platform" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="platform">
                        @foreach ($supportsName as $valor => $nome)
                        <option value="{{ $nome }}">{{ $nome }}</option>
                        @endforeach
                    </select>
                    @error('platform')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="value_per_page" class="block">Quantas telas: </label>
                    <input type="number" name="value_per_page" id="value_per_page" value="{{ old('value_per_page') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('value_per_page')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="value_page_login" class="block">Terá tela de login: </label>
                    <select name="value_page_login" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="value_page_login">
                        <option value="1">Sim </option>
                        <option value="2">Não </option>
                    </select>
                    @error('value_page_login')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="system_pay" class="block">Terá tela de pagamento: </label>
                    <input type="checkbox" name="system_pay" value="" id="system_pay">
                    @error('system_pay')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" id="hidden-input" id="value" name="value">
            <div class="flex justify-end mt-3">
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Cadastrar-se</button>
            </div>
        </form>
    </div>

    <script>
        // Obtém o valor da sessionStorage
        var id = sessionStorage.getItem('id');
        // Define o valor do input hidden
        document.getElementById('hidden-input').value = id;
    </script>
</x-guest-layout>