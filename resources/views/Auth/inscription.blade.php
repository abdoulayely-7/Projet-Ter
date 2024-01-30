{{--@extends('layout.navbar')--}}
{{--@section('content')--}}
    <!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<div class="col-md-6 mt-5 offset-3" >
    <div class="card bg-light " >
        <div class="card-header bg-warning">
            <h1 class="text-center ">Inscription</h1>
            <p class="float-end fw-bold">vous avez déja un compte ?
                <a href="{{route('connexion')}}">Se connecter</a></p>
        </div>
        <div class="card-body ">




            <form method="post" action="{{route('inscription')}}"  class="bg-light">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror"  value="{{old('prenom')}}"  name="prenom"  >
                    @error('prenom')
                    <div class="invalid-feedback">
                        <p style="font-size: 20px; " class="text-danger">            {{$message}}</p>
                    </div>

                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror"  value="{{old('nom')}}" name="nom">
                    @error('nom')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"  name="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}

                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Mot de passe </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}

                    </div>

                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning btn btn-sm col-md-2 fw-bold ">Inscrire</button>
                    <a class="btn btn-danger btn btn-sm col-md-2 float-end fw-bold">Annuler</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>



{{--@endsection--}}
