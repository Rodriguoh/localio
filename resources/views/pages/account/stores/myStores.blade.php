@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">Mes commerces</h1>
    @if (session('successDelete'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successDelete')}}</h4>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="d-none d-sm-table-cell">Ville</th>
                <th class="d-none d-sm-table-cell">Etat</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stores as $store)
            <tr>
                <td>{{$store->name}}</td>
                <td class="d-none d-sm-table-cell">{{$store->city->name}}</td>
                <td class="d-none d-sm-table-cell">{{$store->state->description}}</td>
                <td class="text-right"><a href="{{ route('statsStore', ['idStore' => $store->id])}}" class="btn">Consulter</a></td>
            </tr>
        @endForeach
        </tbody>
    </table>
    <div class="text-center">{{ $stores->links() }}</div>
</div>

@endsection
