@extends('layouts.app')

@section('content')

<div class="card p-0 m-0 m-sm-10">
    <div class="d-flex text-center">
        <h2 class="font-size-22 w-half py-5 m-0 flex-shrink-1">
            Liste des utilisateurs
        </h2>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="d-none d-lg-table-cell">Nom</th>
                <th class="d-none d-lg-table-cell">Prénom</th>
                <th class="d-none d-lg-table-cell">E-mail</th>
                <th class="d-none d-lg-table-cell">Téléphone</th>
                <th class="d-none d-lg-table-cell">Rôle</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->lastname}}</td>
                <td class="d-none d-lg-table-cell">{{$user->firstname}}</td>
                <td class="d-none d-lg-table-cell">{{$user->email}}</td>
                <td class="d-none d-lg-table-cell">{{$user->phone}}</td>
                <td class="d-none d-lg-table-cell">{{$user->role_id}}</td>
            </tr>
        @endforeach    
        </tbody>
    </table>
</div>
@endsection