@extends('layouts.app')
@section('title', 'Ajouter un Etudiant')
@section('titleHeader', 'Ajouter un Etudiant')
@section('content')
<a href="/"><svg fill="#000000" height="80px" width="80px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 219.151 219.151" xml:space="preserve">
<g>
	<path d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575
		C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575
		c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z"/>
	<path d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008
		c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825
		c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628
		c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z"/>
</g>
</svg><a>
    <div class="row mt-4 justify-content-center">
        <div class="col-6">
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="card-header">
                        Formulaire
                    </div>
                    <div class="card-body">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" class="form-control">
    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" class="form-control">
    <label for="phone">Téléphone</label>
    <input type="text" id="phone" name="phone" class="form-control">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control">
    <label for="date_de_naissance">Date de naissance</label>
    <input type="date" id="date_de_naissance" name="date_de_naissance" class="form-control">
    <label for="ville_id">Ville</label>
<select id="ville_id" name="ville_id" class="form-control">
    @foreach($villes as $ville)
        <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
    @endforeach
</select>

</div>

                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </form> 
            </div>
        </div>
    </div>
@endsection