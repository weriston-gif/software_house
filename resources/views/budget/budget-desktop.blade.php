<x-guest-layout>
    @section('title', 'Orçamento de Desktop.')
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
        <form class="w-full" action="{{ route('cadastro-orcamento-mobile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="operational_system" class="block">Qual sistema operacional:</label>
                    <select type="text" name="operational_system" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="operational_system">
                        @foreach ($supportsName as $valor => $nome)
                        <option value="{{ $nome }}">{{ $nome }}</option>
                        @endforeach
                    </select>
                    @error('operational_system')
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
                    <label for="system_pay" class="block">Terá tela de pagamento: </label>
                    <input type="hidden" name="system_pay" value="0">
                    <input type="checkbox" name="system_pay" value="1" id="system_pay">
                    @error('system_pay')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="printer" class="block">Terá impressora: </label>
                    <input type="hidden" name="printer" value="0">
                    <input type="checkbox" name="printer" value="1" id="printer">
                    @error('printer')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="license_access" class="block">Terá licença: </label>
                    <input type="hidden" name="license_access" value="0">
                    <input type="checkbox" name="license_access" value="1" id="license_access">
                    @error('license_access')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="hidden" id="hidden-input" id="value" name="value">
            <input type="hidden" id="type" name="type" value="3">


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