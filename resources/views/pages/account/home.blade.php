@extends('layouts.app')

@section('content')

<!-- Commerçant -->
<div>
    <h1>Bienvenu</h1>
</div>

<div class="account-info">
    <p class="titre-section">Mes informations (<a href="#">modifier</a>)</p>

    <div class="info">
        <div class="data">
            <div class="row">
                <p class="label">Nom:</p>
                <p>Kroese</p>
            </div>
            
            <div class="row">
                <p class="label">Prenom:</p>
                <p>Rodrigue</p>
            </div>

            <div class="row">
                <p class="label">Email:</p>
                <p>rodrigue.kroese@free.fr</p>
            </div>

            <div class="row">
                <p class="label">Telephone</p>
                <p>06 66 66 66 66</p>
            </div>

            <div class="row">
                <p class="label">Mot de passe</p>
                <p>***********</p>
            </div>
        </div>
    </div>
</div>

<div class="gestion-commerce">
        <p class="titre-section">Gerer mes commerces</p>

        <!-- Si le commerçant possède déja un commerce l'afficher -->

        <!-- Sinon -->

        <div class="new-commerce">
            <div class="bar-vertical"></div>
            <div class="bar-horizontal"></div>
        </div>
</div>

@endsection