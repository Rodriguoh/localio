@extends('layouts.app')

@section('content')

<div class="card p-0 m-0 m-sm-10">
    <div class="d-flex text-center">
        <a href="{{ route('myComments') }}" class="font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto flex-shrink-1">Mes Avis</a>

        <h2 class="font-size-22 w-full py-5 m-0">
            Ajouter un avis
        </h2>
    </div>
    <div class="content">
        <form action="{{ route('postComment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="required" for="codeComment">Code commentaire</label>
                @if($errors->has('codeComment'))
                    <div class="invalid-feedback">
                        La code commentaire du commerce est invalide.
                    </div>
                @endif
                <p class="m-0">Ce code a du vous être fournis par le commercant.</p>
                <input type="text" class="form-control" id="codeComment" name="codeComment" value="{{old('codeComment')}}">
            </div>
            <div class="sidebar-divider"></div>

            <div class="form-group">
                <label class="required">Note</label>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        L'attribution d'une note est obligatoire.
                    </div>
                @endif
                <div id="note" class="font-size-22 d-flex flex-row-reverse justify-content-end">
                    <input class="d-none" type="radio" name="note" value="5" id="5">
                    <label for="5"><i class="fa fa-star"></i></label>
                    <input class="d-none" type="radio" name="note" value="4" id="4">
                    <label for="4"><i class="fa fa-star"></i></label>
                    <input class="d-none" type="radio" name="note" value="3" id="3">
                    <label for="3"><i class="fa fa-star"></i></label>
                    <input class="d-none" type="radio" name="note" value="2" id="2">
                    <label for="2"><i class="fa fa-star"></i></label>
                    <input class="d-none" type="radio" name="note" value="1" id="1" checked>
                    <label for="1"><i class="fa fa-star"></i></label>
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="comment">Commentaire</label>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        Veuillez saisir un commentaire.
                    </div>
                @endif
                <textarea class="form-control" id="comment" name="comment">{{old('comment')}}</textarea>
            </div>
            <input type="submit" value="Envoyer" class="btn btn-success">
        </form>
    </div>

    <style>
        #note>input:checked~label>i {
            color: var(--secondary-color);
        }
    </style>
@endsection
