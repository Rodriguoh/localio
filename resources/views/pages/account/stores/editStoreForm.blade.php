@extends('layouts.app')

@section('content')

<div class="card p-0 m-0">
    <div class="d-flex text-center">
        <a href="{{ route('statsStore', ['idStore' => $store->id])}}" class="font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto">Statistique</a>
        <h2 class="font-size-22 w-half py-5 m-0">
            Modifier
        </h2>
    </div>

    <p class="p-10">Vous pouvez modifier les informations de votre commerce, chaque modification doit être validée par un modérateur avant de se retrouver publié sur notre application.</p>


    <div class="content">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('success')}}</h4>
        </div>
        @endif
        @include('components.store-form')
        <div class="sidebar-divider"></div>
        <h3>Supprimer le commerce</h3>
        <p>En supprimant acceptant de supprimer votre commerce, nous supprimerons toutes les informations relatives à celui-ci.</p>
        <div class="dropdown dropup with-arrow">
            <button class="btn btn-danger" data-toggle="dropdown" type="button" id="sign-in-dropdown-toggle-btn" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-trash"></i> Supprimer
            </button>
            <div class="dropdown-menu dropdown-menu-up p-10 w-250" aria-labelledby="delete-dropdown-toggle-btn">
                <div class="dropdown-content p-0">
                    <p>Ecrire <b>votre adresse mail</b> dans le champ suivant, vous acceptez ainsi que nous supprimions votre commerce.</p>
                    <form action="{{route('deleteStore')}}" method="post" class="text-center">
                        @csrf
                        <input type="text" id="confirm" class="form-control my-10" autocomplete="new-password" name="confirmEmail">
                        <div class="dropdown-divider"></div>
                        <input type="hidden" name="id" value="{{$store->id}}">
                        <input class="btn btn-danger mt-5" id="confirmDelete" type="submit" value="Confirmer la suppression" disabled>
                    </form>
                    </div>
                </div>
            </div>
    </div>

</div>
<script>
document.getElementById('confirm').addEventListener('keyup', (ele) => {
    if (@json($store->user->email) === ele.target.value.trim()) {
        document.getElementById('confirmDelete').removeAttribute('disabled');
    }else {
        document.getElementById('confirmDelete').setAttribute('disabled', 'true');
    }
});
</script>
@endsection
