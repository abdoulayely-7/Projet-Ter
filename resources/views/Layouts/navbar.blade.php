
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Reservation</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap -->
    {{--    <link type="text/css" rel="stylesheet" href="pageReservation/css/bootstrap.min.css" />--}}
    <link rel="stylesheet" href="{{ asset('pageReservation/css/bootstrap.min.css') }}">


    <!-- Custom stlylesheet -->
    {{--    <link type="text/css" rel="stylesheet" href="pageReservation/css/style.css" />--}}
    <link rel="stylesheet" href="{{ asset('pageReservation/css/style.css') }}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
{{--    <h1 class="navbar-brand" >Train Express Senegal</h1>--}}
    <h2 class="nav-link mt-3 fw-bold" style="font-size: 30px">Bienvenue {{\Illuminate\Support\Facades\Auth::user()->prenom}} {{\Illuminate\Support\Facades\Auth::user()->nom}}</h2>

    <button class="navbar-toggler" type="button" data-toggle
    ="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        @auth()
            <form class="nav-item float-end mt-3" method="post" role="search" action="{{route('deconnexion')}}">
                @csrf
                @method('delete')


                <button class="nav-link  btn btn-sm fw-bold btn btn-danger">Se deconnecter</button>
            </form>
        @endauth
        @guest()
            <div class="nav-item">
                <a class="nav-link btn btn-success  btn btn-sm fw-bold float-end mt-3" href="{{route('connexion')}}"> Se connecter</a>
            </div>
        @endguest
    </div>
</nav>
@yield('content');
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-2qE2iFuw0Tlt6Fh3uxfaLuknOJhFssN2T9zvW/hG8f+I4KjoH/Kq5Xec1QHJGO9g" crossorigin="anonymous"></script>
</body>
</html>




