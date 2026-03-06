<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\ProfileController;
use App\Models\Client;
use App\Models\Projet;


Route::get('/', function () {
    
    $totalClients = Client::count();
    $projetsEnCours = Projet::where('status', 'En cours')->count();
    $projetsTermines = Projet::where('status', 'Terminé')->count();
    $projetsEnAttente = Projet::where('status', 'En attente')->count();
  
    $caRealise = Projet::where('status', 'Terminé')->sum('budget');

    $totalProjets = Projet::count();
    $tauxReussite = $totalProjets > 0 ? ($projetsTermines / $totalProjets) * 100 : 0;

    return view('welcome', compact(
        'totalClients', 
        'projetsEnCours', 
        'projetsTermines', 
        'projetsEnAttente', 
        'caRealise', 
        'tauxReussite'
    ));
})->middleware(['auth'])->name('dashboard');

Route::resource('clients', ClientController::class)->middleware(['auth']);

Route::resource('projets', ProjetController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
