@extends('layouts.app')

@section('content')

<div class="card p-0 m-0 m-sm-10">
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
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button class="btn btn-secondary btn-square m-2" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="dropdown-toggle-btn-1">
                                <i class="fa fa-eye text-white" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-right" aria-labelledby="dropdown-toggle-btn-1">
                                <p>Modifier le rôle de <b>{{$user->firstname}} {{$user->lastname}}</b></p>

                                <form action="{{ route('editRoleUser') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="form-group">
                                        <label class="required">Rôle:</label>
                                        <select name="role" required="required" class="form-control">
                                            @foreach($roles as $role)
                                                <option {{$user->role_id == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Modifier">
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($user->banned_until == null)
                        <div class="dropdown with-arrow">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button class="btn btn-secondary btn-square m-2 btn-danger" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="dropdown-toggle-btn-2">
                                ✘
                            </button>
                            <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-right" aria-labelledby="dropdown-toggle-btn-2">
                                <p>Suspendre <b>{{$user->firstname}} {{$user->lastname}}</b></p>

                                <form action="{{ route('suspendUser') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="form-group">
                                        <label class="required" for="banned{{$user->id}}">Jusqu'au:</label>
                                        <input type="date" name="banned_until" id="banned{{$user->id}}"><br>
                                        <input type="datetime"
                                               name="banned_until"
                                               id="banned_hidden{{$user->id}}"
                                               value="2037-12-30"
                                               hidden
                                               disabled>
                                        <br>
                                        <input
                                            type="checkbox"
                                            id="indefinite{{$user->id}}"
                                            onchange="
                                                    function _id(x){return document.getElementById(x)};
                                                    if(this.checked === true){
                                                        _id('banned{{$user->id}}').valueAsDate = new Date(2099, 6, 7);
                                                        _id('banned{{$user->id}}').disabled = true;
                                                        _id('banned_hidden{{$user->id}}').disabled = false;
                                                    }else {
                                                        _id('banned{{$user->id}}').value = '{{date('Y-m-d')}}';
                                                        _id('banned_hidden{{$user->id}}').disabled = true;
                                                        _id('banned{{$user->id}}').disabled = false;}">
                                        <label for="indefinite{{$user->id}}">Suspendre indéfiniement</label>
                                    </div>
                                    <input type="submit" class="btn btn-danger" value="Appliquer">
                                </form>
                            </div>
                        </div>
                        </div>
                    @endif
                    @if($user->banned_until != null)
                        <div class="dropdown with-arrow">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button class="btn btn-square m-2 btn-success" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="dropdown-toggle-btn-2">
                                    ✓
                                </button>
                                <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-right" aria-labelledby="dropdown-toggle-btn-2">
                                    <p><b>{{$user->firstname}} {{$user->lastname}}</b><br> est suspendu.e jusqu'au {{$user->banned_until->format('d-m-Y')}}</p>

                                    <form action="{{ route('suspendUser') }}" method="post">
                                        @csrf
                                        <input
                                            type="hidden"
                                            name="id"
                                            value="{{$user->id}}">
                                        <div class="form-group">
                                            <input type="hidden" name="banned_until" value="NULL">
                                        </div>
                                        <input type="submit" class="btn btn-success" value="Lever la suspension">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">{{ $users->links() }}</div>

</div>
<<<<<<< HEAD
=======

>>>>>>> 6a7862b (style)
@endsection
