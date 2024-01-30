                <!DOCTYPE html>
                <html lang="fr">

                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">

                    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                    <title>Reservation</title>

                    <!-- Google font -->
                    <link href="https://fonts.googleapis.com/css?family=Alegreya:700" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400" rel="stylesheet">

                    <!-- Bootstrap -->
                    <link type="text/css" rel="stylesheet" href="{{asset('pageDetails/css/bootstrap.min.css')}}" />

                    <!-- Custom stlylesheet -->
                    <link type="text/css" rel="stylesheet" href="{{asset('pageDetails/css/style.css')}}" />

                    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                    <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                    <![endif]-->

                </head>

                <body>
                {{--<h1>Détails de la Réservation {{ $reservation->id }}</h1>--}}

                <div id="booking" class="section">
                    <div class="section-center">
                        <div class="container">
                            <div class="row">
                                <div class="booking-form">
                                    <form>
                                        <div class="row no-margin">
                                            <div class="col-md-3">
                                                <div class="form-header">
                                                    <h2 class="mt-3s">Reservation Billet Train Express</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row no-margin">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <span class="form-label">Lieu de depart</span>
                                                            <input class="form-control" value="{{$reservation->gareDepart->nom}}" type="text" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <span class="form-label">Zone de depart</span>
                                                            <input class="form-control" value="{{$reservation->gareDepart->zone->nom}}"  readonly>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <span class="form-label">Destination</span>
                                                            <input class="form-control" value="{{$reservation->gareArrivee->nom}}"  type="text" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <span class="form-label">Zone d'arrivee</span>
                                                            <input class="form-control" value="{{$reservation->gareArrivee->zone->nom}}"  readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <span class="form-label">Classe</span>
                                                                <input type="text" value="{{ $reservation->classe}}" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <span class="form-label">Prix</span>
                                                                <input type="text" value="{{ $reservation->prix}}F" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <div class="col-md-2 form-btn">
                                                    {{--                                    {{$qrCode}}--}}
                                                    {{--                                    <p>Date d'expiration : {{ $data['date_expiration'] }}</p>--}}
                                                    {{--                                    <p>Scanner</p>--}}

                {{--                                    <img src='{{asset("qrcodes/qrcode.".$reservation->id.".svg")}}' alt="">--}}
                                                    <img src="{{ asset($reservation->qr_code_path) }}" alt="Code QR">
                                                    <p>Scanner pour plus d infos !!!</p>



                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

                </html>
