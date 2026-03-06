<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Projet;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class ClientController extends Controller
{
public function edit($id)
{
    $client = \App\Models\Client::findOrFail($id);
    return view('clients.edit', compact('client'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'nom_entreprise' => 'required',
        'email' => 'required|email',
        'telephone' => 'required',
    ]);

    $client = \App\Models\Client::findOrFail($id);
    $client->update($request->all());

    return redirect('/clients')->with('success', 'Partenaire mis à jour avec succès !');
}


   public function dashboard()
{
    $totalClients = Client::count(); 
    $totalProjets = Projet::count();
    
    $projetsEnCours = Projet::where('status', 'En cours')->count(); 
    $projetsTermines = Projet::where('status', 'Terminé')->count();
    $projetsEnAttente = Projet::where('status', 'En attente')->count(); 
    
    $caRealise = Projet::where('status', 'Terminé')->sum('budget'); 
    $tauxReussite = $totalProjets > 0 ? ($projetsTermines / $totalProjets) * 100 : 0;
 
    $nouveauxProjetsCount = Projet::where('created_at', '>=', now()->subDay())->count();

    return view('welcome', compact(
        'totalClients', 
        'projetsEnCours', 
        'projetsTermines', 
        'projetsEnAttente', 
        'caRealise', 
        'tauxReussite', 
        'nouveauxProjetsCount' 
    ));
}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::when($search, function ($query, $search) {
            return $query->where('nom_entreprise', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->get();
        return view('clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_entreprise' => 'required', 
            'email' => 'required|email', 
            'telephone' => 'required',
            'logo' => 'nullable' 
        ]);
        
        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Partenaire ajouté !');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return back()->with('success', 'Partenaire supprimé.');
    }
}