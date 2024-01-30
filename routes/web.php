<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('mes-reservations');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/mes-reservations', [ReservationController::class, 'mesReservations'])->name('mes-reservations');
    Route::get('/reservation/{id}', [ReservationController::class, 'detailsReservation'])->name('details-reservation');
    Route::delete('supprimer-reservation/{id}', [ReservationController::class, 'suppremerReservation'])->name('supprimer-reservation');
    Route::get('/modifier-reservation/{id}', [ReservationController::class, 'edit'])->name('edit-reservation');
    Route::put('/modifier-reservation/{id}', [ReservationController::class, 'modifierReservation'])->name('modifier-reservation');
    Route::delete('/deconnexion', [\App\Http\Controllers\AuthController::class, 'deconnexion'])->name('deconnexion');
    Route::get('/admin', [ReservationController::class,'admin'])->name('admin-list');
    Route::delete('supprimer-reservation-utilisateur/{userId}',[ReservationController::class,'supprimerReservationUtilisateur'])->name('supprimer-reservation-parAdmin');

});




// Authentification
Route::group(['middleware' => 'guest'], function () {
        Route::get('/inscription', [\App\Http\Controllers\AuthController::class, 'inscription'])->name('inscription');
        Route::post('/inscription', [\App\Http\Controllers\AuthController::class, 'doInscription'])->name('inscription');
        Route::get('/connexion', [\App\Http\Controllers\AuthController::class, 'connexion'])->name('connexion');
        Route::post('/connexion', [\App\Http\Controllers\AuthController::class, 'doConnexion'])->name('connexion');
});
