<?php

namespace App\Http\Controllers;

use App\Models\Gare;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function admin()
    {
        // Récupérez toutes les réservations
        $reservations = Reservation::all();

        // Calculez le prix total des réservations pour chaque utilisateur
        $reservationsPourUtilisateur = $reservations->groupBy('user_id')->map(function ($reservations) {
            return [
                'prix_total' => $reservations->sum('prix'),
                'nombre_reservations' => $reservations->count(),
            ];
//            map()  transforme chaque groupe de réservations en un tableau contenant le prix total et le nombre de réservation
//            elle prend en argument une foction qui retourne les prix total et le nb_reservation

        });

        // Récupérez la liste des utilisateurs
        $users = User::all();

        // Retournez les données à la vue
        return view('Admin.list-users', compact('reservationsPourUtilisateur', 'users'));
    }

    public function create()
    {
        $garesDepart = Gare::all();
        $garesArrivee = Gare::all();

        return view('Reservation.reservation', compact('garesDepart', 'garesArrivee'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'gare_depart_id' => 'required|string',
                'gare_arrivee_id' => 'required|different:gare_depart_id',
                'prix' => 'required',
                'classe' => 'required',
                'nombre_ticket' => 'required|numeric|min:1',

            ]
        );


        // Créez une nouvelle réservation
        $newReservations = [];
        for ($i = 0; $i < $request->input('nombre_ticket'); $i++) {
            $newReservation = new Reservation([
                'gare_depart_id' => $request->input('gare_depart_id'),
                'gare_arrivee_id' => $request->input('gare_arrivee_id'),
                'prix' => $request->input('prix'),
                'classe' => $request->input('classe'),
            ]);

            //  associez-le  la réservation a l'utilisateur authentifié
            $user = Auth::user();
            $newReservation->user()->associate($user);
            $newReservation->save();
            $newReservations[] = $newReservation;
        }

        // Générez le code QR
        foreach ($newReservations as $newReservation) {
            $expirationDate = Carbon::parse($newReservation->created_at)->addDays(7);
//            La méthode parse() de Carbon permet de convertir une chaîne de caracteres (created_at) représentant une date en un objet Carbon.
//            La méthode addDays() permet d'ajouter un nombre de jours à une date Carbon.
            $data = "
            Numéro reservation: " . $newReservation->id . "\n
            trajet: " . $newReservation->gareDepart->nom . "  -  " . $newReservation->gareArrivee->nom . "\n
            Zone: " . $newReservation->gareDepart->zone->nom . "  -  " . $newReservation->gareArrivee->zone->nom . " \n
            Classe: " . $newReservation->classe . "\n
            Prix: " . $newReservation->prix . "\n
            Date d'achat: " . $newReservation->created_at->format('d-m-Y H:i:s') . "\n
            Date d'expiration : " . $expirationDate->format('d-m-Y H:i:s') . "\n
            ";

            // Enregistrez l'image du code QR dans un dossier public
            $qrCodePath = public_path("qrcodes/qrcode_{$newReservation->id}.svg");
            QrCode::size(170)->generate($data, $qrCodePath);

            // Enregistrez le chemin de l'image du code QR dans la réservation
            $newReservation->qr_code_path = "qrcodes/qrcode_{$newReservation->id}.svg";
            $newReservation->date_expiration =$expirationDate;
            $newReservation->save();
        }

        return redirect()->route('mes-reservations')->with('success', 'Réservation créée avec succès');
    }

    public function mesReservations()
    {
        // Recuperez les reservations de l'utilisateur actuellement authentifie que j ai cree dans le model User
        $reservations = Auth::user()->reservation;
        return view('Reservation.mes-reservations', compact('reservations'));
    }

    public function detailsReservation($id)
    {

        $reservation = Reservation::findOrFail($id);
//        le chemin de l image
        $qr_code_path = $reservation->qr_code_path;
        return view('Reservation.details-reservation', compact('reservation', 'qr_code_path'));
    }

//    supprimer reservation par un utilisateur
    public function suppremerReservation($id)
    {

        $reservation = Reservation::findOrFail($id);

        // verifier que l'utilisateur actuel est le propriétaire de la réservation
        if ($reservation->user_id == auth()->user()->id) {
            // Supprimez la réservation
            $reservation->delete();

            // Redirigez l'utilisateur vers la page des réservations
            return redirect()->route('mes-reservations')->with('supprimer', 'La réservation a été supprimée avec succès.');
        } else {
            // Redirigez l'utilisateur avec un message d'erreur si la  réservation qui ne lui appartient pas
            return redirect()->route('mes-reservations')->with('error', "Vous n'avez pas l'autorisation de supprimer cette réservation.");
        }
    }

//    supprimer reservation par l administrateur
public function supprimerReservationUtilisateur($userId): \Illuminate\Http\RedirectResponse
{
    $user=User::find($userId);
    $reservations = $user->reservation;
//    $reservations -> delete(); ne passe pas car Le résultat est un objet de type Collection
// qui contient les réservations de l'utilisateur.
    $reservations->each(function($reservation) {
//        each parcours la collection de $reservations
        $reservation->delete();
    });
    return redirect()->route('admin-list')->with('supprimer', 'La réservation a été supprimée avec succès.');
}

    public function edit($id)
    {
        $garesDepart = Gare::all();
        $garesArrivee = Gare::all();
        $reservation = Reservation::findOrFail($id);
        if ($reservation->user_id == Auth::user()->id) {
            return view('Reservation.modifier-reservation', compact('reservation', 'garesDepart', 'garesArrivee'));
        } else {
            return redirect()->route('mes-reservations')->with('error', "Vous n'avez pas l'autorisation de modifier cette réservation.");
        }
    }

    public function modifierReservation(Request $request, $id)
    {

        $reservation = Reservation::findOrFail($id);

        $expirationDate = Carbon::now()->addDays(7);

        if ($reservation->user_id == auth()->user()->id) {
            $request->validate([
                'gare_depart_id' => 'required',
                'gare_arrivee_id' => 'required|different:gare_depart_id',
                'prix' => 'required',
                'classe' => 'required',
            ]);


            $reservation->update([
                'gare_depart_id' => $request->input('gare_depart_id'),
                'gare_arrivee_id' => $request->input('gare_arrivee_id'),
                'classe' => $request->input('classe'),
                'prix' => $request->input('prix'),
            ]);
            // Générez le nouveau code QR
            $data = "id: " . $reservation->id . "\n
            trajet: " . $reservation->gareDepart->nom . "  -  " . $reservation->gareArrivee->nom . "\n
            Zone: " . $reservation->gareDepart->zone->nom . "  -  " . $reservation->gareArrivee->zone->nom . " \n
            Classe: " . $reservation->classe . "\n
            Prix: " . $reservation->prix . " \n
            Date d'achat: " . $reservation->created_at->format('d-m-Y H:i:s') . "\n
            Date d'expiration : " . $expirationDate->format('d-m-Y H:i:s') . "\n
            ";

            // Enregistrez l'image du nouveau code QR dans un dossier public
            $qrCodePath = public_path("qrcodes/qrcode_{$reservation->id}.svg");
            QrCode::size(180)->generate($data, $qrCodePath);

            // Enregistrez le chemin de l'image du nouveau code QR dans la réservation
            $reservation->qr_code_path = "qrcodes/qrcode_{$reservation->id}.svg";
            $reservation->date_expiration =$expirationDate;
            $reservation->save();
        }

        return redirect()->route('mes-reservations')->with('modifier', 'La réservation a été modifiée avec succès.');


    }
}

