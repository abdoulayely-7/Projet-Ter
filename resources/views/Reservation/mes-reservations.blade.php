@extends('Layouts.navbarMesReservation')
@section('content')
        <div class="col-md-8 offset-2 mt-5 bg-secondary">
            <h1 class="text-capitalize text-white fw-bold">Mes Réservations
                <a class="btn btn-primary text-white btn btn-sm fw-bold float-end mt-2" href="{{route('reservations.create')}}">Reserver</a>

            </h1>
            <h3>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session("success")}}</strong>.
                        <form action="">
                            <button type="submit" class=" btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </form>
                    </div>
                @endif
                @if(session('supprimer'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{session("supprimer")}}</strong>.
                        <form action="">
                            <button type="submit" class=" btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </form>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{session("error")}}</strong>.
                        <form action="">
                            <button type="submit" class=" btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </form>
                    </div>
                @endif
                @if(session('modifier'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session("modifier")}}</strong>.
                        <form action="">
                            <button type="submit" class=" btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </form>
                    </div>
                @endif
            </h3>
        </div>
        <div class="row mt-4">
            @php $numeroReservation =1 @endphp
            @if($reservations->isEmpty())
                <div class="cold-md-4 offset-5">
                    <img src="{{asset('pageMesReservation/image/Confused.png')}}" alt="" class="confused-image">
                    <p class="text-danger">Vous n'avez fait aucune réservation !!!!</p>
                </div>
            @else
                @foreach($reservations as $reservation)
                    <div class="col-md-3 mb-3">

                        <div class="card border-secondary mb-3">
                            <div class="card-header bg-secondary text-center">
                                <h5 class="card-title text-uppercase text-white">Réservation {{ $numeroReservation }}</h5>
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text fw-bold">Gare de départ: {{ $reservation->gareDepart->nom }}</p>
                                <p class="card-text fw-bold">Gare d'arrivée: {{ $reservation->gareArrivee->nom }} </p>
                            </div>
                            <div class="card-footer bg-secondary">
                                <form action="{{route('supprimer-reservation',$reservation->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class=" ">
                                        <a href="{{ route('details-reservation', ['id' => $reservation->id]) }}" style="margin-left: 40px" class="fw-bold text-white btn btn-primary btn btn-sm  mb-1">Détails</a>
                                        <a href="{{ route('edit-reservation', ['id' => $reservation->id]) }}" class="fw-bold text-white btn btn-warning btn btn-sm mb-1">Modier</a>
                                        <button class="btn btn-danger text-white fw-bold btn btn-sm mb-1"> Supprimer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @php $numeroReservation ++ @endphp
                @endforeach
            @endif
        </div>



@endsection
