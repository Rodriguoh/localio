@extends('layouts.app')

@section('content')
<h1>Traiter les demandes de mise en ligne</h1>
<table class="table">
    <thead>
        <tr class="d-flex">
            <th class="col-sm-1">Utilisateur</th>
            <th class="col-sm-2">Nom du commerce</th>
            <th class="col-sm-4">Description du commerce</th>
            <th class="col-sm-2">Date d'ajout</th>
            <th class="col-sm-1">Etat actuel</th>
            <th class="col-sm-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stores as $store)
        <tr class="d-flex">
            <td class="col-sm-1">{{$store->lastname.' '.$store->firstname}}</td>
            <td class="col-sm-2">{{$store->name}}</td>
            <td class="col-sm-4">{{$store->description}}</td>
            <td class="col-sm-2">{{$store->created_at}}</td>
            <td class="col-sm-1">{{$store->state_id}}</td>
            <td class="col-sm-2"></td>
        </tr>

        @endforeach
    </tbody>
</table>
{{ $stores->links() }}
@endsection
