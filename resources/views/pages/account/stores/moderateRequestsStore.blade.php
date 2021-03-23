@extends('layouts.app')

@section('content')
<div class="card p-0 m-5 m-sm-10">
    <h1 class="card-title p-15">Demandes de mise en ligne de commerce</h1>
    @if(isset($stores) && $stores->count() > 0)
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="d-none d-md-table-cell">Utilisateur</th>
                <th class="">Nom du commerce</th>
                <th class="d-none d-lg-table-cell">Ville</th>
                <th class="d-none d-md-table-cell">Date d'ajout</th>
                <th class="">Etat actuel</th>
                <th class="">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($stores as $store)
            <tr>
                <td class="d-none d-md-table-cell">{{$store->lastname.' '.$store->firstname}}</td>
                <td class="">{{$store->name}}</td>
                <td class="d-none d-lg-table-cell">{{$store->city_name}}</td>
                <td class="d-none d-md-table-cell">{{$store->created_at}}</td>
                <td class="">{{$store->state_label}}</td>
                <td class="">
                    <a href="{{ route('showStore', ['idStore' => $store->id]) }}" class="btn btn-secondary btn-square m-2" type="button"><i class="fa fa-eye" style="color:white" aria-hidden="true"></i></a>
                    <a href="#modal-confirmationApprove" onclick="editModalOnApprove(`{{$store->id}}`, `{{$store->name}}`)" class="btn btn-success btn-square m-2" type="button"><i class="fa fa-check" style="color:white" aria-hidden="true"></i></a>
                    <a href="#modal-confirmationRefuse" onclick="editModalOnRefuse(`{{$store->id}}`, `{{$store->name}}`)" class="btn btn-danger btn-square m-2" type="button"><i class="fa fa-times" style="color:white" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Il n'y a actuellement aucune demande de mise en ligne de stores</p>
    @endif

    @if(isset($stores) && $stores->count() > 0)
    <div class="text-center m-5">{{ $stores->links() }}</div>
    @endif


</div>
@if(isset($stores) && $stores->count() > 0)
<!-- Modal confirmation approve -->
<div class="modal" id="modal-confirmationApprove" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" role="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
            <h5 class="modal-title">Êtes-vous sûr de vouloir approuver ce commerce ? </h5>
            <p>
                Si vous confirmer le commerce {{$store->name}} sera approuvé.
            </p>
            <div class="text-right mt-20">
                <!-- text-right = text-align: right, mt-20 = margin-top: 2rem (20px) -->
                <a href="#" class="btn btn-danger mr-5" role="button">Annuler</a>
                <a onclick="" class="btn btn-success" role="button">Approuver</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal confirmation refuse -->
<div class="modal" id="modal-confirmationRefuse" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" role="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
            <h5 class="modal-title">Êtes-vous sûr de vouloir refuser ce commerce ? </h5>
            <p>
                Si vous confirmer le commerce {{$store->name}} sera refusé.
            </p>
            <div class="text-right mt-20">
                <!-- text-right = text-align: right, mt-20 = margin-top: 2rem (20px) -->
                <a href="#" class="btn btn-danger mr-5" role="button">Annuler</a>
                <a href="{{URL::route('refuseStore', ['idStore' => $store->id])}}" class="btn btn-success" role="button">Refuser</a>
            </div>
        </div>
    </div>
</div>
@endif
<script>
    function editModalOnApprove(idStore, nameStore) {
        //Change the approve link to the correct id
        let nodeLink = document.querySelector('#modal-confirmationApprove .modal-dialog .modal-content div .btn-success');
        let newLink = document.location.origin + document.location.pathname.slice(0, -14) + `approveStore/${idStore}`;
        nodeLink.setAttribute('href', newLink);

        //Change the text to the correct name
        let textNode = document.querySelector('#modal-confirmationApprove .modal-dialog .modal-content p');
        textNode.innerHTML = `Si vous confirmer le commerce ${nameStore} sera approuvé.`;
    }

    function editModalOnRefuse(idStore, nameStore) {
        //Change the approve link to the correct id
        let nodeLink = document.querySelector('#modal-confirmationRefuse .modal-dialog .modal-content div .btn-success');
        let newLink = document.location.origin + document.location.pathname.slice(0, -14) + `refuseStore/${idStore}`;
        nodeLink.setAttribute('href', newLink);

        //Change the text to the correct name
        let textNode = document.querySelector('#modal-confirmationRefuse .modal-dialog .modal-content p');
        textNode.innerHTML = `Si vous confirmer le commerce ${nameStore} sera refusé.`;
    }

</script>
@endsection
