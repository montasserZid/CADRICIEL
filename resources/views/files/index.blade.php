@extends('layouts.app')

@section('title', trans('lang.file_directory'))
@section('titleHeader', trans('lang.file_directory'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('lang.file_directory')</div>
                   
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($files->isEmpty())
                            <p>Aucun fichier partagé.</p>
                        @else
                            <div class="mb-3">
                                <button id="lang-fr" class="btn btn-sm btn-primary lang-btn">@lang('lang.francais')</button>
                                <button id="lang-en" class="btn btn-sm btn-primary lang-btn">@lang('lang.anglais')</button>
                            </div>

                            @foreach ($files as $file)
                                <div class="file mb-3">
                                    <h5 id="file-name">
                                        @if(app()->getLocale() === 'fr')
                                            {{ $file->filename_fr }}
                                        @elseif(app()->getLocale() === 'en')
                                            {{ $file->filename_en }}
                                        @endif
                                    </h5>
                                    <p>@lang('lang.author') : {{ $file->user->etudiant->nom }}</p>

                                    @if (auth()->user()->id === $file->user_id)
                                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">@lang('lang.delete_etudiant')</button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-danger" disabled>@lang('lang.delete_etudiant')</button>
                                    @endif
                                </div>
                            @endforeach

                            <div class="pagination">
                                {{ $files->links() }}
                            </div>
                        @endif
                        <a href="{{ route('files.create') }}" class="btn btn-primary">@lang('lang.add_file')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const langButtons = document.querySelectorAll('.lang-btn');
            const fileElements = document.querySelectorAll('.file');

            // Afficher la langue par défaut
            const defaultLang = '{{ app()->getLocale() }}';
            fileElements.forEach(function(fileElement) {
                const fileNameElement = fileElement.querySelector('h5');

                if (defaultLang === 'fr') {
                    fileNameElement.innerText = '{{ $file->filename_fr }}';
                } else if (defaultLang === 'en') {
                    fileNameElement.innerText = '{{ $file->filename_en }}';
                }
            });

            langButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const lang = button.id.split('-')[1];

                    fileElements.forEach(function(fileElement) {
                        const fileNameElement = fileElement.querySelector('h5');

                        if (lang === 'fr') {
                            fileNameElement.innerText = '{{ $file->filename_fr }}';
                        } else if (lang === 'en') {
                            fileNameElement.innerText = '{{ $file->filename_en }}';
                        }
                    });
                });
            });
        });
    </script>
@endsection

