<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function confirmMobile(button) {
            var id = button.getAttribute('data-attr');

            axios.post('/mobile', {
                    id: id,
                    _token: '{{ csrf_token() }}'

                })
                .then(function(response) {
                    // Lógica para lidar com a resposta da requisição
                    console.log(response.data);
                })
                .catch(function(error) {
                    // Lógica para lidar com erros na requisição
                    console.error(error);
                });

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
</body>

</html>