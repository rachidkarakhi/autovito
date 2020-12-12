@extends('layouts.app')



@section('content')
<div class="error_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="error_form">
                    <h1>403</h1>
                    <h2>Accès refusé/interdit </h2>
                    <!-- <p>Sorry but the page you are looking for does not exist, have been<br> removed, name changed or is temporarity unavailable.</p> -->

                  <a href="{{ url('/') }}">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
