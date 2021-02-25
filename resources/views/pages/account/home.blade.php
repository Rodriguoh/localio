@extends('layouts.app')

@section('content')

<div class="card m-0">
    <h1 class="card-title">Mes informations</h1>
    @if (session('successEdit'))
    <div class="alert alert-success mb-10" role="alert">
        <button class="close" data-dismiss="alert" type="button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">{{session('successEdit')}}</h4>
    </div>
    @endif
    <form id="form-info" action="{{route('editUsersInformations')}}" method="POST" class="w-400 mw-full">
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="form-group">
            <label for="lastname">Nom</label>
            @if($errors->has('lastname'))
            <div class="invalid-feedback">
                {{$errors->first('lastname')}}
            </div>
            @endif
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user->lastname}}" disabled>
        </div>

        <div class="form-group">
            @if($errors->has('firstname'))
            <div class="invalid-feedback">
                {{$errors->first('firstname')}}
            </div>
            @endif
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user->firstname}}" disabled>
        </div>

        <div class="form-group">
            <label for="email" class="required">Adresse Email</label>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
            @endif
            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" disabled>
        </div>

        <div class="form-group">
            <label for="phone">Numéro de téléphone</label>
            @if($errors->has('phone'))
            <div class="invalid-feedback">
                {{$errors->first('phone')}}
            </div>
            @endif
            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" disabled>
        </div>

        @if($user->role->name == 'user')
        <div class="custom-switch">
            <input type="checkbox" id="switch-commercant" value="true" name="isCommercant" disabled="disabled">
            <label for="switch-commercant">Je suis un commercant</label>
            <p class="text-muted">Pour être commercant vous devez renseigné votre nom, prénom ainsi que numéro de téléphone.</p>
          </div>
        @endif

        <div class="d-flex justify-content-between">
            <input id="availableEdit" class="btn px-0 px-sm-10 btn-secondary" type="button" value="Modifier mes informations">
            <input id="submitEdit" class="btn btn-success d-none" type="submit" value="Modifier">
            <input id="disableEdit" type="reset" value="Annuler" class="btn d-none">
        </div>
    </form>

</div>

<script>
    var form = [...document.querySelectorAll('#form-info input[type="text"]')];

    document.getElementById('availableEdit').addEventListener('click',() => {
        form.map((input) => {
            input.removeAttribute('disabled');
        });
        document.getElementById('switch-commercant').removeAttribute('disabled');
        document.getElementById('availableEdit').classList.add('d-none');
        document.getElementById('submitEdit').classList.remove('d-none');
        document.getElementById('disableEdit').classList.remove('d-none');
    });

    document.getElementById('disableEdit').addEventListener('click', () => {
        form.map((input) => {
            input.setAttribute('disabled', 'disabled');
        });
        document.getElementById('switch-commercant').setAttribute('disabled', 'disabled');
        document.getElementById('availableEdit').classList.remove('d-none');
        document.getElementById('submitEdit').classList.add('d-none');
        document.getElementById('disableEdit').classList.add('d-none');
    });
</script>



@endsection
