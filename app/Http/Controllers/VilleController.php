<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;

class VilleController extends Controller
{
    public function index()
    {
        // Récupérer toutes les villes depuis la base de données
        $villes = Ville::all();

        // Retourner la vue pour afficher les villes avec les données récupérées
        return view('villes.index', compact('villes'));
    }

    public function create()
    {
        // Retourner la vue du formulaire de création d'une nouvelle ville
        return view('villes.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire de création
        $request->validate([
            'nom' => 'required',
        ]);

        // Créer une nouvelle ville dans la base de données
        Ville::create($request->all());

        // Rediriger vers la liste des villes après la création
        return redirect()->route('villes.index')->with('success', 'Ville créée avec succès.');
    }

    public function show(Ville $ville)
    {
        // Retourner la vue pour afficher les détails d'une ville spécifique
        return view('villes.show', compact('ville'));
    }

    public function edit(Ville $ville)
    {
        // Retourner la vue du formulaire d'édition d'une ville spécifique
        return view('villes.edit', compact('ville'));
    }

    public function update(Request $request, Ville $ville)
    {
        // Valider les données du formulaire d'édition
        $request->validate([
            'nom' => 'required',
        ]);

        // Mettre à jour les informations de la ville dans la base de données
        $ville->update($request->all());

        // Rediriger vers la liste des villes après la mise à jour
        return redirect()->route('villes.index')->with('success', 'Ville mise à jour avec succès.');
    }

    public function destroy(Ville $ville)
    {
        // Supprimer la ville de la base de données
        $ville->delete();

        // Rediriger vers la liste des villes après la suppression
        return redirect()->route('villes.index')->with('success', 'Ville supprimée avec succès.');
    }
}
