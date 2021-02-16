@extends('layouts.app')

@section('content')

<!-- Commerçant -->

<div class="container">

    <div>
        <h1>Bienvenu</h1>
    </div>

    <div class="account-info">
        <p class="titre-section">Mes informations (<a href="#">modifier</a>)</p>

        <div class="info">
            <div class="data">
                <div class="row">
                    <p class="label">Nom:</p>
                    <p>{{$user->lastname}}</p>
                </div>
                
                <div class="row">
                    <p class="label">Prenom:</p>
                    <p>{{$user->firstname}}</p>
                </div>

                <div class="row">
                    <p class="label">Email:</p>
                    <p>{{$user->email}}</p>
                </div>

                <div class="row">
                    <p class="label">Telephone:</p>
                    <p>{{$user->phone}}</p>
                </div>

                <div class="row">
                    <p class="label">Mot de passe:</p>
                    <p>***********</p>
                </div>
            </div>
        </div>
    </div>

    <div class="gestion-commerce">
            <p class="titre-section">Gerer mes commerces</p>

            <!-- Si le commerçant possède déja un commerce l'afficher -->

            <!-- Sinon -->

            <a href="#" class="new-commerce">
                <div class="bar-vertical"></div>
                <div class="bar-horizontal"></div>
            </a>
    </div>

</div>





@endsection