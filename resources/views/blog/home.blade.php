@extends('layouts.app')
@section('title', 'Page Home')

@section('content')


    <div class="container">
        <div class="text-center mt-5">
            <h1>@lang('lang.title1')</h1>
            <p class="lead">@lang('lang.title2')</p>
                 <a href="{{ route('blog.create', ) }}" class="btn btn-primary">@lang('lang.add_etudiant')</a>
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
                    <th>@lang('lang.name')</th>
                    <!-- <th>Adresse</th>
                    <th>Téléphone</th> -->
                    <th>@lang('lang.email')</th>
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
                    @auth
                        @if($etudiant->id === auth()->user()->etudiant_id)
                        <button onclick="location.href='{{ route('blog.edit', ['etudiant' => $etudiant->id]) }}'" class="btn btn-warning{{ $etudiant->id !== auth()->user()->etudiant_id ? ' disabled' : '' }}">@lang('lang.edit_etudiant')</button>&nbsp;

                    @else
                    <button href="#" class="btn btn-warning" disabled="disabled" onclick="return false;">@lang('lang.edit_etudiant')</button>&nbsp;
                    @endif  
                    @endauth
                    <form method="POST" action="{{ route('etudiant.destroy', $etudiant->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" disabled>@lang('lang.delete_etudiant')</button>
                    </form>


 
                </td>
                </tr>
                @endforeach
                <div class="pagination">
                        {{ $etudiants->links() }}
                    </div>
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
