<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Client;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index(Request $request)
    {
       
        $status = $request->query('status');

        $projets = Projet::with('client')
            ->when($status, function ($query, $status) {
               
                return $query->where('status', $status);
            })
            ->latest()
            ->get();

        $clients = Client::all();

        return view('projets.index', compact('projets', 'clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'client_id' => 'required|exists:clients,id',
            'budget' => 'required|numeric',
            'status' => 'required',
            'deadline'=> 'nullable|date'

        ]);

        Projet::create($request->all());
        return redirect()->route('projets.index')->with('success', 'Nouveau projet lancé avec succès !');
    }

    public function edit($id)
    {
        $projet = Projet::findOrFail($id);
        $clients = Client::all();
        return view('projets.edit', compact('projet', 'clients'));
    }

  public function update(Request $request, $id)
{
    $projet = Projet::findOrFail($id);

    $request->validate([
        'titre' => 'required',
        'client_id' => 'required|exists:clients,id',
        'budget' => 'required|numeric',
        'status' => 'required'
    ]);

    $projet->update($request->all());

    return redirect()->route('projets.index')->with('success', 'Le projet a été mis à jour avec succès !');
}

    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();
        return back()->with('success', 'Le projet a été annulé.');
    }
}