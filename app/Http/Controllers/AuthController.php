<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function inscription()
    {
        return view('auth.inscription');
    }
    public function doInscription(Request $request)
    {
        $request -> validate(
            [
                'prenom'=>'required',
                'nom'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required'
            ]
        );
        $user = new User();
        $user -> prenom = $request['prenom'];
        $user -> nom = $request['nom'];
        $user -> email = $request['email'];
        $user -> password =Hash::make($request['password']);

        $user -> save();
        return to_route('connexion')->with('success','Inscription reussie');
    }
    public function connexion()
    {
        return view('auth.connexion');
    }
    public function reservation()
    {
        return view('Reservation.reservation');
    }
    public  function doConnexion(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'=>'required|email',
                'password'=>'required'
            ]
        );
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect()->route('admin-list');
            } else {
                return redirect()->route('mes-reservations')->with('connexion', 'Connexion reussie');
            }
        }
        return back()->with('error','Email ou mot de passe incorrecte');
    }

        public function deconnexion()
    {
        Auth::logout();
        return redirect()->route('connexion');
    }
}
