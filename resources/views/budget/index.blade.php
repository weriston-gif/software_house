<x-guest-layout>
    <div id="toggleMyModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tabela de preço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descrção</th>
                                <th>Valor da pagina login</th>
                                <th>Valalor por página</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->value_page_login }}</td>
                                <td>{{ $item->value_per_page }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container d-flex justify-content-center mt-5">
        <form class="w-full" action="{{ route('cadastro-orcamento.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="name" class="block">Nome:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('name')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="email" class="block">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('email')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="telefone" class="block">Telefone:</label>
                    <input type="text" name="telefone" value="telefone" id="telefone" class="w-full rounded-md p-2 border border-gray-300" placeholder="+55 9999-9999">
                    @error('telefone')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="cep" class="block">CEP:</label>
                    <input type="text" name="cep" id="cep" value="{{ old('cep') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('cep')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="rua" class="block">Rua:</label>
                    <input type="text" name="rua" id="rua" value="{{ old('rua') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('rua')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="numero" class="block">Número:</label>
                    <input type="text" name="numero" id="numero" value="{{ old('numero') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('numero')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="bairro" class="block">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('bairro')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">

                    <label for="complemento" class="block">Complemento:</label>
                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('complemento')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="municipio" class="block">Município:</label>
                    <input type="text" name="municipio" id="municipio" value="{{ old('municipio') ?? '' }}" class="w-full rounded-md p-2 border border-gray-300">
                    @error('municipio')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="uf" class="block">UF:</label>
                    <input type="text" name="uf" id="uf" value="{{ old('uf') ?? '' }}" class="w-100 rounded-md p-2 border border-gray-300">
                    @error('uf')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="pais" class="block">País:</label>
                    <input type="text" name="pais" id="pais" value="{{ old('pais') ?? '' }}" class="w-100 rounded-md p-2 border border-gray-300">
                    @error('pais')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end mt-3">
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Cadastrar-se</button>
                </div>
            </div>
        </form>
    </div>



</x-guest-layout>

@if(session('success'))
@php
$botton = '<div class="d-flex justify-content-center">
    <button data-attr="' . session('budgetId') . '" type="button" class="btn btn-outline-primary mx-2">
        <a href="' . route('cadastro-orcamento-mobile.index') . '">Web</a>
    </button>
    <button onclick="confirmMobile(this)" data-attr="' . session('budgetId') . '" type="button" class="btn btn-outline-primary mx-2">
        <a href="' . route('cadastro-orcamento-mobile.index') . '">Mobile</a>
    </button>
    <button data-attr="' . session('budgetId') . '" type="button" class="btn btn-outline-primary mx-2">
        <a href="' . route('cadastro-orcamento-mobile.index') . '">Desktop</a>
    </button>
</div>';
@endphp
<script>
    let botton = `{!! $botton !!}`;

    Swal.fire({
        title: 'Success!',
        text: "{{ session('budgetId') }}",
        icon: 'success',
        showConfirmButton: false,
        footer: botton,
    });
</script>

@elseif(session('erro'))
<script>
    Swal.fire(
        'Oops...',
        'Erro ao cadastrar-se!',
        'error'
    )
</script>
@else
<script>
    $(document).ready(function() {
        $('#toggleMyModal').modal('show');
    });
</script>
<script>
    function confirmMobile(button) {
        var id = button.getAttribute('data-attr');
        alert(id);

        sessionStorage.setItem('id', id);
    }

    function limpa_formulario_cep() {
        // Limpa valores dos campos de endereço.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#pais").val("");
    }

    // Quando o campo CEP perde o foco.
    $("#cep").blur(function() {
        // Nova variável "cep" somente com dígitos.
        let cep = $(this).val().replace(/\D/g, '');

        // Verifica se o campo CEP possui valor informado.
        if (cep !== "") {
            // Expressão regular para validar o CEP.
            let validacep = /^[0-9]{8}$/;

            // Valida o formato do CEP.
            if (validacep.test(cep)) {
                // Preenche os campos com "..." enquanto consulta o serviço do ViaCEP.
                $("#rua").val("").addClass("animate-pulse bg-gray-200");
                $("#bairro").val("").addClass("animate-pulse bg-gray-200");
                $("#cidade").val("").addClass("animate-pulse bg-gray-200");
                $("#uf").val("").addClass("animate-pulse bg-gray-200");
                $("#pais").val("").addClass("animate-pulse bg-gray-200");


                // Consulta o webservice do ViaCEP.
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        // Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro).removeClass("animate-pulse bg-gray-200");
                        $("#bairro").val(dados.bairro).removeClass("animate-pulse bg-gray-200");
                        $("#cidade").val(dados.localidade).removeClass("animate-pulse bg-gray-200");
                        $("#uf").val(dados.uf).removeClass("animate-pulse bg-gray-200");
                        $("#pais").val("Brasil").removeClass("animate-pulse bg-gray-200");

                    } else {
                        // CEP pesquisado não foi encontrado.
                        limpa_formulario_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                // CEP é inválido.
                limpa_formulario_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            // CEP sem valor, limpa o formulário.
            limpa_formulario_cep();
        }
    });
</script>
@endif