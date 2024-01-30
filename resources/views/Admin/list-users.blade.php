@extends('Layouts.navbar')
@section('content')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center bg-info">
                            <h1>Liste des  réservations</h1>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="text-center h3">
                                <tr>
                                    <th>Nom</th>
                                    <th>Nombre de réservations</th>
                                    <th>Prix total</th>
                                </tr>
                                </thead>
                                <tbody class="text-center h4">
                                @foreach ($reservationsPourUtilisateur as $userId => $reservation)
{{--                                   $reservationsPourUtilisateur est un tableau associatif contenat les infos des  reservations pour chaque utlisateur
                                        $userID est la cle de chaque element du tableau c a d l id des users
--}}
                                    <tr>
                                        <td>{{ $users->find($userId)->prenom }} {{$users->find($userId)->nom}}</td>
                                        <td>{{ $reservation['nombre_reservations'] }}</td>
                                        <td>{{ $reservation['prix_total'] }}</td>
                                        <td>
                                            <form action="{{route('supprimer-reservation-parAdmin',$userId)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger ">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
