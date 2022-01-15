<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Controle de Séries</title>
</head>
<body>
<nav class="navbar navbar-light bg-light mb-2 d-flex justify-content-between me-2">
    <div class="container-fluid">
        @auth
            <div class="d-flex">
                <a class="navbar-brand" href="{{ route('listar_series') }}">
                    <img src="{{URL::asset('/img/home.png')}}" alt="" width="30px" height="30px"
                         class="d-inline-block align-text-top  ms-3">
                    Home
                </a>
                <a class="navbar-brand" href="{{ route('userAll') }}">
                    <img src="{{URL::asset('/img/users.png')}}" alt="" width="30px" height="30px"
                         class="d-inline-block align-text-top  ms-3">
                    Usuários
                </a>

            </div>
            <div class="justify-content-between">
                <a class="navbar-brand" href="{{ route('profile') }}">
                    <i class="bi bi-person"></i>
                    {{--                    {{ Auth::user()->name }}--}}
                </a>
                <a href="/sair" class="text-danger">
                    Sair
                </a>
            </div>

        @endauth
    </div>
</nav>
<div class="container">
    <div class="h-100 p-5 text-white bg-dark   rounded-3">
        <h1>@yield('titulo')</h1>
    </div>
    {{--    <button class="btn btn-outline-link small float-right" onclick="goBack()">voltar</button>--}}
    <hr>

    @yield('conteudo')
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script>
    function goBack() {
        window.history.back()
    }
</script>
</body>
</html>

