@extends('layouts.app')

@section('content')

<div class="card p-0 m-0 m-sm-10 table-responsive">
    <div class="d-flex text-center">
        <h2 class="font-size-22 w-half py-5 m-0 flex-shrink-1">
            Liste des utilisateurs
        </h2>
    </div>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="d-lg-table-cell">Nom</th>
                <th class="d-none d-lg-table-cell">Prénom</th>
                <th class="d-none d-lg-table-cell">E-mail</th>
                <th class="d-none d-lg-table-cell">Téléphone</th>
                <th class="d-lg-table-cell">Rôle</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->lastname}}</td>
                <td class="d-none d-lg-table-cell">{{$user->firstname}}</td>
                <td class="d-none d-lg-table-cell">{{$user->email}}</td>
                <td class="d-none d-lg-table-cell">{{$user->phone}}</td>
                <td class="d-lg-table-cell">{{$user->role->name}}</td>
                <td class="text-center">
                    <div class="dropdown with-arrow">
                        <button class="btn btn-secondary btn-square m-2" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-eye text-white" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-right">
                            <p>Modifier le rôle de <b>{{$user->firstname}} {{$user->lastname}}</b></p>
                        
                            <form action="{{ route('editRoleUser') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="form-group">
                                    <label class="required">Rôle :</label>
                                    <select name="role" required="required" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success" value="Modifier">
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach    
        </tbody>
    </table>
    <div class="text-center">{{ $users->links() }}</div>

</div>

@endsection