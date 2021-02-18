@extends('layouts.app')

@section('content')

<!-- Commerçant -->
{{--  --}}
<div class="card">
    <h2 class="card-title">
        Information du commerce
      </h2>
<form action="{{route('postStore')}}" method="POST" class="w-400 mw-full">
    @csrf
    <input type="hidden" name="id" value="{{$store->id}}">
    <div class="form-group">
        <label for="name" class="required">Nom du commerce</label>
        @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                  </div>
                @endif
        <input type="text" class="form-control" id="name" placeholder="Nom entier" name="name">
    </div>
    <div class="form-group">
        <label for="phone" class="required">Numéro de téléphone</label>
        @if($errors->has('phone'))
                <div class="invalid-feedback">
                    {{$errors->first('phone')}}
                  </div>
                @endif
        <input type="text" class="form-control" id="phone" placeholder="Numéro" name="phone">
    </div>
    <div class="form-group">
        <label for="mail" class="required">Adresse Mail</label>
        @if($errors->has('mail'))
                <div class="invalid-feedback">
                    {{$errors->first('mail')}}
                  </div>
                @endif
        <input type="text" class="form-control" id="mail" placeholder="Mail" name="mail">
    </div>
    <div class="form-group">
        <label for="SIRET" class="required">Numéro de SIRET</label>
        @if($errors->has('SIRET'))
                <div class="invalid-feedback">
                    {{$errors->first('SIRET')}}
                  </div>
                @endif
        <input type="text" class="form-control" id="SIRET" placeholder="SIRET" name="SIRET">
    </div>
    <div class="form-group">
        <label for="url">URL de votre site internet</label>
        <input type="text" class="form-control" id="url" placeholder="L'url" name="url">
    </div>

    <div class="form-group">
        <label for="category" class="required">Categorie</label>
        <select class="form-control" id="category" required name="category_id">
            <option value="" selected="selected" disabled="disabled">Choisir une catégorie</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->label}}</option>
                @foreach($category->child as $categoryChild)
                    <option value="{{$categoryChild->id}}"> -  {{$categoryChild->label}}</option>
                @endforeach
            @endforeach
        </select>
    </div>

    <textarea name="editor" id="editor"></textarea>

    <h3 class="card-title">
        Localisation
    </h3>

    <div>
        <label for="number" class="required">Adresse</label>
        <div class="form-row row-eq-spacing">
        <div class="col">
            <input type="text" class="form-control" id="number" placeholder="Numéro" name="number" required="required">
        </div>
        <div class="col">
            <input type="text" class="form-control" id="street" placeholder="Rue" name="street" required="required">
        </div>
        </div>
    </div>

    <h4>Provisoire</h4>
    <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" class="form-control" id="city" placeholder="Le nom de la ville" name="city">
    </div>
    <div class="form-group">
        <label for="INSEE">INSEE</label>
        <input type="text" class="form-control" id="INSEE" placeholder="Numéro INSEE" name="INSEE">
    </div>
    <div class="form-group">
        <label for="ZIPCode">Code Postal</label>
        <input type="text" class="form-control" id="ZIPCode" placeholder="Code postal" name="ZIPCode">
    </div>

    <H3>Localisation Provisoire</H3>
    <div class="form-group">
        <label for="lng">Longitude</label>
        <input type="text" class="form-control" id="lng" name="lng">
    </div>
    <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" id="lat" name="lat">
    </div>

    <h3 class="card-title">
        Livraison
        </h3>
    <div class="custom-switch">
        <input type="checkbox" id="delivery" value="true" name="delivery">
        <label for="delivery">Propose la livraison</label>
    </div>

    <div class="form-group">
        <label for="conditionDelivery">Condition de livraison</label>
        <textarea class="form-control" id="conditionDelivery" name="conditionDelivery" placeholder="Condition de livraison"></textarea>
    </div>




    <input class="btn btn-success" type="submit" value="Valider">
</div>
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
