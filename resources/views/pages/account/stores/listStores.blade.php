@extends('layouts.app')

@section('content')
<div class="card p-0 m-0">
    <h1 class="card-title px-15 mt-15">Les commerces</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Nom</th>
            <th class="d-none d-lg-table-cell">Ville</th>
            <th class="d-none d-sm-table-cell">Etat</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
          <tr>
            <td>{{$store->name}}</td>
            <td class="d-none d-lg-table-cell">{{$store->city->name}}</td>
            <td class="d-none d-sm-table-cell">{{$store->state->description}}</td>
            <td class="text-right"><a href="" class="btn">Consulter</a></td>
          </tr>
          @endForeach
        </tbody>
      </table>
      <div class="text-center">{{ $stores->links() }}</div>
</div>

@endsection
