@extends('layouts.app')
@section('title', 'Page Home')

@section('content')
    <div class="container">
        <div class="text-center mt-5">
            <h1>La liste des étudiants inscrits</h1>
            <p class="lead">voici une liste des étudiants inscrits</p>
                 <a href="{{ route('blog.create', ) }}" class="btn btn-primary">Ajouter un étudiant</a>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- <p>Bootstrap v5.2.3</p> -->
            <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <!-- <th>Adresse</th>
                    <th>Téléphone</th> -->
                    <th>Email</th>
                    <!-- <th>Date de naissance</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Boucle pour afficher les étudiants -->
                @foreach($etudiants as $etudiant)
                <tr>
                <td><a href="{{ route('blog.show', ['etudiantId' => $etudiant->id]) }}">{{ $etudiant->nom }}</a></td>

                    <!-- <td>{{ $etudiant->adresse }}</td>
                    <td>{{ $etudiant->phone }}</td> -->
                    <td>{{ $etudiant->email }}</td>
                    <!-- <td>{{ $etudiant->date_de_naissance }}</td> -->
                    <td>
                    <a href="{{ route('blog.edit', ['etudiant' => $etudiant->id]) }}">Modifier</a>  &nbsp
                    <form method="POST" action="{{ route('etudiant.destroy', $etudiant->id) }}" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link text-danger">Supprimer</button>
</form>
 
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
@endsection
    </body>
</html>
