@extends('layouts.app')
@section('title', trans('lang.add_etudiant'))
@section('titleHeader', 'add_etudiant')
@section('content')
<a href="/"><svg fill="#000000" height="80px" width="80px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 219.151 219.151" xml:space="preserve">
<g>
    <path d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575
        C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575
        c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z"/>
    <path d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008
        c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825
        c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628
        c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z"/>
</g>
</svg></a>
<main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 pt-4">
                    <div class="card">
                        <h3 class="card-header text-center">
                            Enregistrer
                        </h3>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                            <form action="{{route('user.store')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Name" class="form-control" name="name" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" placeholder="email" class="form-control" name="email" value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('password')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="d-grid mx-auto">
                                    <input type="submit" value="Sauvegarder" class="btn btn-dark btn-block">
                                </div>
                            </form>       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection