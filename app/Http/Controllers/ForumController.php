<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;

class ForumController extends Controller
{
    public function index()
    {
            $articles = Forum::paginate(2);
            $etudiant = auth()->user()->etudiant;

        // Passer les articles à la vue pour les afficher
        return view('forum.index', compact('articles'))->with('etudiant', $etudiant);
       
    }

    public function create()
    {
        $etudiant = auth()->user()->etudiant;
        // Afficher le formulaire de création d'un nouvel article
        return view('forum.create')->with('etudiant', $etudiant);
    }

    public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'title_fr' => 'required|min:3',
        'title_en' => 'required|min:3',
        'content_fr' => 'required|min:10',
        'content_en' => 'required|min:10',
    ]);

    // Créer un nouvel article dans la base de données
    Forum::create([
        'title_fr' => $request->title_fr,
        'title_en' => $request->title_fr,
        'content_fr' => $request->content_fr,
        'content_en' => $request->content_en,
        'user_id' => auth()->user()->id, // L'ID de l'utilisateur connecté
    ]);

    // Rediriger vers la page du forum avec un message de succès
    return redirect('/forum')->with('success', 'Article créé avec succès.');
}


    public function edit($id)
    {
        // Récupérer l'article à modifier
        $article = Forum::findOrFail($id);

        // Vérifier si l'utilisateur connecté est l'auteur de l'article
        if ($article->user_id !== auth()->user()->id) {
            return redirect('/forum')->with('error', "Vous n'êtes pas autorisé à modifier cet article.");
        }
        $etudiant = auth()->user()->etudiant;
        // Afficher le formulaire d'édition de l'article
        return view('forum.edit', compact('article'))->with('etudiant', $etudiant);
    }

    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'title_fr' => 'required|min:3',
            'title_en' => 'required|min:3',
            'content_fr' => 'required|min:10',
            'content_en' => 'required|min:10',
        ]);

        // Récupérer l'article à modifier
        $article = Forum::findOrFail($id);

        // Vérifier si l'utilisateur connecté est l'auteur de l'article
        if ($article->user_id !== auth()->user()->id) {
            return redirect('/forum')->with('error', "Vous n'êtes pas autorisé à modifier cet article.");
        }

        // Mettre à jour les données de l'article
        $article->update([
            'title_fr' => $request->title_fr,
            'title_en' => $request->title_en,
            'content_fr' => $request->content_fr,
            'content_en' => $request->content_en,
            
        ]);

        // Rediriger vers la page du forum avec un message de succès
        return redirect('/forum')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer l'article à supprimer
        $article = Forum::findOrFail($id);

        // Vérifier si l'utilisateur connecté est l'auteur de l'article
        if ($article->user_id !== auth()->user()->id) {
            return redirect('/forum')->with('error', "Vous n'êtes pas autorisé à supprimer cet article.");
        }

        // Supprimer l'article de la base de données
        $article->delete();

        // Rediriger vers la page du forum avec un message de succès
        return redirect('/forum')->with('success', 'Article supprimé avec succès.');
    }
}
