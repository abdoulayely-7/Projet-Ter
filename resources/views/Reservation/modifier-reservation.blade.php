@extends('Layouts.navbar')
@section('content')
            <div id="booking" class="section">
                <div class="section-center">
                    <div class="container">
                        <div class="row">
                            <div class="booking-form">
                                <form method="post" action="{{ route('modifier-reservation',$reservation->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="form-label">Lieu de départ</span>
                                                <select name="gare_depart_id" id="gareDepart" class="form-control" >
                                                    @foreach ($garesDepart  as $gare)
                                                        <option value="{{ $gare->id }}" {{ $reservation->gare_depart_id == $gare->id ? 'selected' : '' }}>{{ $gare->nom }} </option>
                                                        {{--                                            - {{ $gare->zone->nom }}--}}
                                                    @endforeach
                                                </select>
                                                <span class="select-arrow"></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="form-label"> déstination</span>
                                                <select name="gare_arrivee_id" id="gareArrivee" class="form-control" >
                                                    @foreach ($garesArrivee as $gare)
                                                        <option value="{{ $gare->id }}"{{ $reservation->gare_arrivee_id == $gare->id ? 'selected' : '' }}>{{ $gare->nom }} </option>
                                                        {{--                                            - {{ $gare->zone->nom }}--}}
                                                    @endforeach
                                                </select>

                                                <span class="select-arrow"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row float-right">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <span class="form-label">Classe</span>
                                                <select name="classe" id="classe" class="form-control">
                                                    <option value="">Veuilez choisir une classe</option>
                                                    <option value="Première classe" {{$reservation->classe ==='Première classe' ? 'selected' : ''}}>Première classe</option>
                                                    <option value="Deuxième classe" {{$reservation->classe ==='Deuxième classe' ? 'selected' : ''}}>Deuxième classe</option>
                                                    <option value="Troisième classe" {{$reservation->classe ==='Troisième classe' ? 'selected' : ''}}>Troisième classe</option>
                                                </select>
                                                <span class="select-arrow"></span>
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <span class="form-label">Prix</span>
                                                <input class="form-control" id="prix"  value="{{$reservation->prix}}" name="prix" type="text"  readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="form-btn">
                                                <button type="submit" class="submitt-btn  btn-info" id="reserver">Réserver</button>
                                            </div>
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
                const gareDepart=document.querySelector('#gareDepart');
                const gareArrivee=document.querySelector('#gareArrivee');


                gareDepart.addEventListener('change', () => {
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

            // declencher l evenement de changement du prix en fonction des gares et dela classe
            //         prix.dispatchEvent(new Event('input'));


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
                    // prix.dispatchEvent(new Event('input'));
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
                    // prix.dispatchEvent(new Event('input'));
                });
                reserver.onclick= function() {
                    if (gareDepart.value==="" || gareArrivee.value==="" || classe.value==="")
                    {
                        alert  ('Veuillez remplir tous les champs');
                        return false;
                    }
                    return true;
                }

            </script>

@endsection
