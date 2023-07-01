<x-guest-layout>
    <h3>Orçamento Mobile</h3>

    <div class="container d-flex justify-content-center mt-5">
        <form class="w-full" action="{{ route('budget.budget-mobile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="platform" class="block">Qual plataforma:</label>
                    <select name="platform" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="platform">
                        @foreach ($supportsName as $valor => $nome)
                        <option value="{{ $valor }}">{{ $nome }}</option>
                        @endforeach
                    </select>
                    @error('platform')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end mt-3">
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Cadastrar-se</button>
            </div>
        </form>
    </div>

</x-guest-layout>