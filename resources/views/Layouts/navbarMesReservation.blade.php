<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('pageMesReservation/style.css') }}">

    <title>Mes reservations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    {{--    <h1 class="navbar-brand" >Train Express Senegal</h1>--}}
    <h2 class="nav-link mt-3 fw-bold" style="font-size: 30px">Bienvenue {{\Illuminate\Support\Facades\Auth::user()->prenom}} {{\Illuminate\Support\Facades\Auth::user()->nom}}</h2>

    <button class="navbar-toggler" type="button" data-toggle
    ="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">

        @auth()
            <form class="nav-item  mt-2" style="margin-left: 900px" method="post" role="search" action="{{route('deconnexion')}}">
                @csrf
                @method('delete')
                <button class="btn btn-sm fw-bold btn btn-danger">Se deconnecter</button>
            </form>
        @endauth
        @guest()
            <div class="nav-item">
                <a class="nav-link btn btn-success  btn btn-sm fw-bold float-end mt-3" href="{{route('connexion')}}"> Se connecter</a>
            </div>
        @endguest
    </div>
</nav>
@yield('content')
</body>
</html>
