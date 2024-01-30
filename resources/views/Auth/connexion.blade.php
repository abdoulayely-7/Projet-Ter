{{--@extends('layout.navbar')--}}
{{--@section('content')--}}
    <!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<div class="col-md-6 mt-5 offset-3" >
    <div class="card bg-light " >
        <div class="card-header bg-warning">
            <h1 class="text-center float-right">
                Connexion
            </h1>
            <p class="float-end fw-bold">vous n'avez pas encore de compte ?
                <a href="{{route('inscription')}}">S'inscrire</a></p>
        </div>
        <div class="card-body ">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session('success')}}</strong>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session('error')}}</strong>
                </div>
            @endif
            <form method="post" action="{{route('connexion')}}"  class="">
                @csrf
                @method('post')
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
                    <label for="password" class="form-label">Mot de passe </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}

                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning btn btn-sm col-md-2 fw-bold ">Connexion</button>
                    <a class="btn btn-danger btn btn-sm col-md-2 float-end fw-bold">Annuler</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>



{{--@endsection--}}
