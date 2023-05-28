<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    
    public function index()
    {
        // Récupérer tous les étudiants depuis la base de données
        $etudiants = Etudiant::all(); // Remplacez Etudiant par le nom de votre modèle d'étudiant

        return view('blog.home')->with('etudiants', $etudiants);
    }

    public function create()
    {
        // Retourner la vue du formulaire de création d'un nouvel étudiant
        $villes = Ville::all();
        // var_dump('hello');
        // die;
        return view('blog.create')->with('villes', $villes);
        
    }

        public function store(Request $request)
    {
        //return $request;

        $newEtudiant = Etudiant::create($request->all());


        return redirect()->route('blog.home')->with('success', 'Étudiant ' . $newEtudiant->nom . ' ajouté avec succès.');
        //return view ('blog.show', ['blogPost' => $newPost]);
    }

public function show($etudiantId)
{
    $etudiant = Etudiant::findOrFail(intval($etudiantId));

    if ($etudiant === null) {
        return response("Etudiant with id {$etudiantId} not found");
    }else{
        response($etudiant);
    }
  

    //   var_dump($etudiant);
    // die;
    return view('blog.show', ['etudiant' => $etudiant]);
}


    
    

    // public function edit(Etudiant $etudiant)
    // {
        
    //     return view('etudiants.edit', compact('etudiant'));
    // }
    public function edit($id)
{
    $etudiant = Etudiant::findOrFail($id);
    // var_dump($etudiant);
    return view('blog.edit', compact('etudiant'));
}


    public function update(Request $request, Etudiant $etudiant)
    {


        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse
        ]);
        // Rediriger vers la liste des étudiants après la mise à jour
        return redirect(route('blog.edit', $etudiant))->with('success', 'Étudiant ' . $etudiant->nom . ' mis à jour avec succès.');


        // return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(Etudiant $etudiant)
    {
        // Supprimer l'étudiant de la base de données
        $etudiant->delete();

        // Rediriger vers la liste des étudiants après la suppression
        return redirect()->route('blog.home')->with('success', 'Étudiant '.$etudiant->nom. ' supprimé avec succès.');
    }
}
