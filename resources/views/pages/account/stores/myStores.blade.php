@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">Mes commerces</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Ville</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
          <tr>
            <td>{{$store->name}}</td>
            <td>{{$store->city->name}}</td>
            <td class="text-right"><a href="" class="btn">Consulter</a></td>
          </tr>
          @endForeach
        </tbody>
      </table>
      <div class="text-center">{{ $stores->links() }}</div>
</div>

@endsection
