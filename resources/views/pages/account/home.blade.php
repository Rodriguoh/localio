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
    @if (session('successPassword'))
    <div class="alert alert-success mb-10" role="alert">
        <button class="close" data-dismiss="alert" type="button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">{{session('successPassword')}}</h4>
    </div>
    @endif
    <form id="form-info" action="{{route('editUsersInformations')}}" method="POST" class="w-400 mw-full">
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="form-group">
            <label for="lastname">Nom</label>
            @if($errors->has('lastname'))
                <div class="invalid-feedback">
                    Le nom est obligatoire.
                </div>
            @endif
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user->lastname}}" disabled>
        </div>

        <div class="form-group">
            @if($errors->has('firstname'))
            <div class="invalid-feedback">
                Le prénom est obligatoire.
            </div>
            @endif
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user->firstname}}" disabled>
        </div>

        <div class="form-group">
            <label for="email" class="required">Adresse Email</label>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                L'adresse email est obligatoire.
            </div>
            @endif
            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" disabled>
        </div>

        <div class="form-group">
            <label for="phone">Numéro de téléphone</label>
            @if($errors->has('phone'))
            <div class="invalid-feedback">
                Le numéro de téléphone est obligatoire.
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
    <div class="sidebar-divider"></div>
    <h2 class="card-title">Modifier mon mots de passe</h2>
    <form action="{{route('editPassword')}}" method="POST" class="w-400 wm-full">
        @csrf
        @if($user->password)
        <div class="form-group">
            @if($errors->has('current-password'))
            <div class="invalid-feedback">
                Le mots de passe ne correspond pas a l'ancien.
            </div>
            @endif
            <label for="current-password">Mon ancien mots de passe</label>
            <input type="password" class="form-control" id="current-password" name="current-password" autocomplete="new-password">
        </div>
        @endif
        <div class="form-group">
            @if($errors->has('password'))
            <div class="invalid-feedback">
                Le mots de passe doit comporter au moins 8 caractères.
            </div>
            @endif
            <label for="password">Mon nouveau mots de passe</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
        </div>
        <div class="form-group">
            @if($errors->has('confirm-password'))
            <div class="invalid-feedback">
                Le mots de passe n'est pas identique.
            </div>
            @endif
            <label for="confirm-password">Confirmer mon mots de passe</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" autocomplete="new-password">
        </div>

        <input id="editPassword" class="btn px-0 px-sm-10 btn-secondary" type="submit" value="Modifier" disabled>
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

    document.querySelector('#password').addEventListener('keyup', (ele) => {
        if(ele.target.value === document.querySelector('#confirm-password').value) {
            document.getElementById('editPassword').removeAttribute('disabled');
        } else {
            document.getElementById('editPassword').setAttribute('disabled', 'disabled');
        }
    });

    document.querySelector('#confirm-password').addEventListener('keyup', (ele) => {
        if(ele.target.value === document.querySelector('#password').value) {
            document.getElementById('editPassword').removeAttribute('disabled');
        } else {
            document.getElementById('editPassword').setAttribute('disabled', 'disabled');
        }
    });
</script>



@endsection
