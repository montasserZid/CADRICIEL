@extends('layouts.app')

@section('title', 'forum')
@section('titleHeader', 'forum')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum</div>
                <a href="{{ route('forum.create') }}" class="btn btn-primary mb-3">@lang('lang.create_article')</a>
                <div class="card-body">
                  

                    
                    <div class="mb-3">
                        <button id="lang-fr" class="btn btn-sm btn-primary lang-btn">@lang('lang.francais')</button>
                        <button id="lang-en" class="btn btn-sm btn-primary lang-btn">@lang('lang.anglais')</button>
                    </div>

                    @foreach($articles as $article)
                        <div class="article mb-3" data-lang="fr">
               
                            <h5>{{ $article->title_fr }}</h5>
                            <p>{{ $article->content_fr }}</p>
                            <!-- <p>@lang('lang.lang') : {{ $article->language }}</p> -->
                            <p>@lang('lang.author') : {{ $article->user->etudiant->nom}}</p>

                            @if(auth()->user()->id === $article->user_id)
                                <a href="{{ route('forum.edit', $article->id) }}" class="btn btn-sm btn-primary">@lang('lang.edit_etudiant')</a>
                                <form action="{{ route('forum.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">@lang('lang.delete_etudiant')</button>
                                </form>
                            @endif
                        </div>

                        <div class="article mb-3" data-lang="en">
                            <h5>{{ $article->title_en }}</h5>
                            <p>{{ $article->content_en }}</p>
                            <!-- <p>@lang('lang.lang') : {{ $article->language }}</p> -->
                            
                            <p>@lang('lang.author') : {{ $article->user->etudiant->nom}}</p>

                            @if(auth()->user()->id === $article->user_id)
                                <a href="{{ route('forum.edit', $article->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                <form action="{{ route('forum.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            @endif
                        </div>
                        <hr>
                    @endforeach

                    <div class="pagination">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const langButtons = document.querySelectorAll('.lang-btn');
    const articles = document.querySelectorAll('.article');

    // Afficher uniquement la langue locale par défaut
    const locale = '{{ app()->getLocale() }}';
    articles.forEach(function(article) {
        const articleLang = article.getAttribute('data-lang');
        if (articleLang !== locale) {
            article.style.display = 'none';
        }
    });

    langButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const lang = button.id.split('-')[1];

            articles.forEach(function(article) {
                const articleLang = article.getAttribute('data-lang');

                if (articleLang === lang) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        });
    });
});

</script>

@endsection
