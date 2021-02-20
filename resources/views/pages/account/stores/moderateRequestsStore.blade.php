@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">Demandes de mise en ligne de commerce</h1>
    <table class="table table-striped">
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
                <td class="col-sm-1">{{$store->state_label}}</td>
                <td class="col-sm-2">
                    <a href=""><button class="btn btn-secondary btn-square m-2" type="button"><i class="fa fa-eye" style="color:white" aria-hidden="true"></i></button></a>
                    <a href=""><button class="btn btn-success btn-square m-2" type="button"><i class="fa fa-check" style="color:white" aria-hidden="true"></i></button></a>
                    <a href=""><button class="btn btn-danger btn-square m-2" type="button"><i class="fa fa-times" style="color:white" aria-hidden="true"></i></button></a>
                    
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <div class="text-center m-5">{{ $stores->links() }}</div>
</div>


@endsection
