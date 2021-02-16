@extends('layouts.app')

@section('content')

<!-- Commerçant -->
{{--  --}}
<form action="{{route('postStore')}}" method="POST" class="w-400 mw-full">
    @csrf
    <input type="hidden" name="id" value="{{$store->id}}">
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
    <div class="form-group">
        <label for="name" class="required">Nom du commerce</label>
        <input type="text" class="form-control" id="name" placeholder="Nom entier" name="name">
    </div>
    <div class="form-group">
        <label for="phone" class="required">Numéro de téléphone</label>
        <input type="text" class="form-control" id="phone" placeholder="Numéro" name="phone">
    </div>
    <div class="form-group">
        <label for="mail" class="required">Adresse Mail</label>
        <input type="text" class="form-control" id="mail" placeholder="Mail" name="mail">
    </div>
    <div class="form-group">
        <label for="SIRET" class="required">Numéro de SIRET</label>
        <input type="text" class="form-control" id="SIRET" placeholder="SIRET" name="SIRET">
    </div>
    <div class="form-group">
        <label for="url">URL de votre site internet</label>
        <input type="text" class="form-control" id="url" placeholder="L'url" name="url">
    </div>

    <textarea name="editor" id="editor"></textarea>


    <input class="btn btn-success" type="submit" value="Valider">

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        var editor = CKEDITOR.replace( 'editor', {
            filebrowserUploadUrl: "{{route('ckeditor.upload',['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            uiColor: '#ADD8E6',
            width:'85%',
            height:500
        } );
    </script>


@endsection
