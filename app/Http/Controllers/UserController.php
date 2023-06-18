<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Ville;
use App\Models\Etudiant;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //integer $villes aussi dans le model
        $villes = Ville::all();
        return view('blog.createUser')->with('villes', $villes);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //validation 
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date',
            'ville' => 'required',
            'password' => 'required|min:6|max:20'
        ]);
        //
        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_de_naissance' => $request->dob,
            'ville_id' => $request->ville,
        ]);
    
        // Créer un nouvel utilisateur associé à l'étudiant
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'etudiant_id' => $etudiant->id,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // $user = new User();
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $dob = Carbon::createFromFormat('Y-m-d', $request->input('dob'));
        // $user->password = bcrypt($dob->format('dmY')); // Utilisez la date de naissance formatée comme mot de passe par défaut
        // $user->save();
    

        // $etudiant = new Etudiant();
        // $etudiant->nom = $request->input('nom');
       
        // $etudiant->save();
          // Validation des champs du formulaire
          $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'date_de_naissance' => 'required|date',
            'ville_id' => 'required',
            'password' => 'required|min:6|max:20|confirmed',
        ]);
        

    // Création de l'étudiant
    $etudiant = Etudiant::create([
        'nom' => $request->nom,
        'adresse' => $request->adresse,
        'phone' => $request->phone,
        'email' => $request->email,
        'date_de_naissance' => Carbon::parse($request->date_de_naissance),
        'ville_id' => $request->ville_id,
    ]);


    $user = User::create([
        'etudiant_id' => $etudiant->id,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
    $etudiant->email = $request->email;
    $etudiant->save();
    $user->save();

    return view('auth.index')->with('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
    
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function generateDefaultPasswords()
{
    $etudiants = Etudiant::all();

    foreach ($etudiants as $etudiant) {
        $dob = Carbon::createFromFormat('Y-m-d', $etudiant->date_de_naissance);
        $password = $dob->format('dmY');

        $user = new User();
        $user->etudiant_id = $etudiant->id;
        $user->email = $etudiant->email;
        $user->password = Hash::make($password);
        $user->save();
    }
}
}
