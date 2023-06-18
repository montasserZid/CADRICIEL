<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\Etudiant;

use Carbon\Carbon;

class EtudiantController extends Controller
{
    
    public function index()
    {
        // Récupérer tous les étudiants depuis la base de données
        // $etudiants = Etudiant::all(); 
        //paginate
        // Passer les étudiants à la vue pour les afficher
        $etudiants = Etudiant::paginate(10);

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
        // ...
    
        $newEtudiant = Etudiant::create($request->all());
    
        // Générer le mot de passe par défaut à partir de la date de naissance
        $dob = Carbon::createFromFormat('Y-m-d', $request->input('date_de_naissance'));
        $defaultPassword = $dob->format('dmY');
    
        // Créer un nouvel utilisateur associé à l'étudiant avec le mot de passe par défaut
        $userController = new UserController();
        $userController->generateDefaultPassword($newEtudiant, $defaultPassword);
    
        // ...
    
        return redirect()->route('blog.home')->with('success', 'Étudiant ' . $newEtudiant->nom . ' ajouté avec succès.');
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
    $villes = Ville::all();
    $etudiant = Etudiant::findOrFail($id);
    // var_dump($etudiant);
    return view('blog.edit', compact('etudiant'))->with('villes', $villes);
}


    public function update(Request $request, Etudiant $etudiant)
    {

        
        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            // 'date_de_naissance' => $request->date_de_naissance,
            'phone' => $request->phone,
            'ville_id' => $request->ville_id,
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
