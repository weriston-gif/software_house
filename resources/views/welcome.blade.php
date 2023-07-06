<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color: #e9e9e9;" class="">
    <div class="d-flex flex-row-reverse bd-highlight py-5">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <a href="{{ url('/dashboard') }}" class="p-2 bd-highlight text-decoration-none ">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="p-2 bd-highlight text-decoration-none">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="p-2 bd-highlight text-decoration-none">Register</a>
            @endif
            @endauth
        </div>
        @endif


    </div>
    <div class="container mx-auto px-4 items-center">
        <h1>Bem vindo a Software House </h1>
        <h4 class="lead mb-5">
            Faça orçamentos dos seus sistemas, Mobile, Desktop ou Web.
        </h4>
        <div class="d-flex justify-content-center">
            <a href="{{ route('cadastro-orcamento.index') }}" class="btn btn-outline-primary">
                Faça seu orçamento
            </a>
        </div>


    </div>


</body>

</html>