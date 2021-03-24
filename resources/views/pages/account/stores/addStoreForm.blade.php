@extends('layouts.app')

@section('content')

<div class="card m-0">
    <h2 class="card-title">
        Création d'un commerce
    </h2>
    <p>Ici, vous pouvez créer votre commerce en renseignant les informations qui nous permettrons de le mettre en avant sur note application.
         Les informations que vous nous ferez parvenir seront vérifié avant d'être publiée.
        </p>
    @include('components.store-form')
</div>
@endsection
