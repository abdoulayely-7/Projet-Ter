@extends('Layouts.navbar')
@section('content')

<div id="booking" class="section">
    <div class="section-center">
        <div class="container">
            <div class="row">
                <div class="booking-form">
                    <form method="post" action="{{ route('reservations.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Lieu de départ</span>
                                    <select name="gare_depart_id" id="gareDepart" class="form-control @error('gare_depart_id') is-invalid @enderror" >
                                        <option value="">Veuiller choisir un gare départ</option>
                                        @foreach ($garesDepart  as $gare)
                                            <option value="{{ $gare->id }}">{{ $gare->nom }} </option>
                                            {{--                                            - {{ $gare->zone->nom }}--}}
                                        @endforeach
                                    </select>
                                    <span class="select-arrow"></span>
                                    @error('gare_depart_id')
                                    <div class="invalid-feedback">
                                        <p style="font-size: 20px" class="text-danger">            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label"> déstination</span>
                                    <select name="gare_arrivee_id" id="gareArrivee" class="form-control @error('gare_arrivee_id') is-invalid @enderror" >
                                        <option value="">Veuiller choisir un gare d'arrivée</option>
                                        @foreach ($garesArrivee as $gare)
                                            <option value="{{ $gare->id }}">{{ $gare->nom }} </option>
                                        @endforeach
                                    </select>
                                    <span class="select-arrow"></span>
                                        @error('gare_arrivee_id')
                                            <div class="invalid-feedback">
                                                <p style="font-size: 20px" class="text-danger">            {{$message}}</p>
                                            </div>
                                        @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row float-right">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="form-label">Classe</span>
                                    <select name="classe" id="classe" class="form-control @error('classe') is-invalid @enderror">
                                        <option value="">Veuilez choisir une classe</option>
                                        <option value="Première classe">Première classe</option>
                                        <option value="Deuxième classe">Deuxième classe</option>
                                        <option value="Troisième classe">Troisième classe</option>
                                    </select>
                                    <span class="select-arrow"></span>
                                    @error('classe')
                                    <div class="invalid-feedback">
                                        <p style="font-size: 20px" class="text-danger">            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <span for="nombre_reservations" class="label">Nombre de tickets</span>
                                    <input type="number" name="nombre_ticket" id="nombre_ticket" class="form-control @error('nombre_ticket') is-invalid @enderror">
                                    @error('nombre_ticket')
                                    <div class="invalid-feedback">
                                        <p style="font-size: 20px" class="text-danger">
                                            {{$message}}
                                        </p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="form-label">Prix</span>
                                    <input class="form-control" id="prix"  name="prix" type="text"  readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3 ">
                            <div class="form-btn">
                                <button type="submit" class="submitt-btn  btn-info" id="reserver">Réserver</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    {{--    recuperer les donner sous forme de tableau des gares de depart et d arrivee --}}
    const tabGareDepart = {!! json_encode($garesDepart) !!};
    const tabGareArrivee = {!! json_encode($garesArrivee) !!};
    const prix = document.getElementById('prix');
    const reserver = document.getElementById('reserver');
    const classe = document.getElementById('classe');
    const nombre_reservations = document.getElementById('nombre_reservations');
    const gareDepart=document.querySelector('#gareDepart');
    const gareArrivee=document.querySelector('#gareArrivee');


    gareDepart.addEventListener('change', () => {
        // je recupere les donnees consernant une gare en le donnant l id de la gare choisis
        let zone1 = tabGareDepart.find( e=> e.id == +gareDepart.value);
        let zone2 = tabGareArrivee.find( e=> e.id == +gareArrivee.value);
        // console.log(gareDepart);
        // console.log(gareArrivee);
        console.log(gareDepart.value);
        console.log(gareArrivee.value);
        console.log(zone1);
        console.log(zone2);
        // ici j ai acces a l id de la zone en passant par zone1.zone_id  parce que
        // j ai acces a tous les infos de la gare conserne avec la variable zone1 ou2
        // console.log(zone1.zone_id);
        // console.log(zone2.zone_id);



        let nouvellePrix = 0;

        switch (Math.abs(zone2.zone_id - zone1.zone_id)) {
            case 0:
                nouvellePrix = 500;
                break;
            case 1:
                nouvellePrix = 1000;
                break;
            case 2:
                nouvellePrix = 1500;
                break;
        }
        switch (classe.value) {
            case 'Première classe':
                prix.value = nouvellePrix + 500;
                break;
            case 'Deuxième classe':
                prix.value = nouvellePrix + 250;
                break;
            case 'Troisième classe':
                prix.value = nouvellePrix ;
                break;
        }

        if (gareDepart.value===gareArrivee.value)
        {
            alert  ('Veuillez choisir 2 gars différents !!!');
            prix.value="";
            gareDepart.value="";
        }
    });
    gareArrivee.addEventListener('change', () => {
        let zone1 = tabGareDepart.find( e=> e.id == +gareDepart.value);
        let zone2 = tabGareArrivee.find( e=> e.id == +gareArrivee.value);
        console.log(zone1.zone_id);
        console.log(zone2.zone_id);

        let nouvellePrix = 0;

        switch (Math.abs(zone2.zone_id - zone1.zone_id)) {
            case 0:
                nouvellePrix = 500;
                break;
            case 1:
                nouvellePrix = 1000;
                break;
            case 2:
                nouvellePrix = 1500;
                break;
        }
        switch (classe.value) {
            case 'Première classe':
                prix.value = nouvellePrix + 500;
                break;
            case 'Deuxième classe':
                prix.value = nouvellePrix + 250;
                break;
            case 'Troisième classe':
                prix.value = nouvellePrix ;
                break;
        }

        if (gareDepart.value===gareArrivee.value)
        {
            alert  ('Veuillez choisir 2 gars différents !!!');
            prix.value="";
            gareArrivee.value="";
        }
    });

    classe.addEventListener('change', () => {
        let zone1 = tabGareDepart.find(e => e.id == +gareDepart.value);
        let zone2 = tabGareArrivee.find(e => e.id == +gareArrivee.value);
        let nouvellePrix = 0;

        switch (Math.abs(zone2.zone_id - zone1.zone_id)) {
            case 0:
                nouvellePrix = 500;
                break;
            case 1:
                nouvellePrix = 1000;
                break;
            case 2:
                nouvellePrix = 1500;
                break;
        }
        switch (classe.value) {
            case 'Première classe':
                prix.value = nouvellePrix + 500;
                break;
            case 'Deuxième classe':
                prix.value = nouvellePrix + 250;
                break;
            case 'Troisième classe':
                prix.value = nouvellePrix ;
                break;
        }

    });
     reserver.onclick= function() {
        if (gareDepart.value==="" || gareArrivee.value==="" || classe.value==="" )
        {
            alert  ('Veuillez remplir tous les champs');
            return false;
        }
         return true;
    }

</script>




@endsection
