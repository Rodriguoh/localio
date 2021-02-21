@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">Demandes de mise en ligne de commerce</h1>
    @if(isset($stores) && $stores->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr class="d-flex">
                <th class="col-sm-1">Utilisateur</th>
                <th class="col-sm-2">Nom du commerce</th>
                <th class="col-sm-4">Description du commerce</th>
                <th class="col-sm-2">Date d'ajout</th>
                <th class="col-sm-1">Etat actuel</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($stores as $store)
            <tr class="d-flex">
                <td class="col-sm-1">{{$store->lastname.' '.$store->firstname}}</td>
                <td class="col-sm-2">{{$store->name}}</td>
                <td class="col-sm-4">{{$store->description}}</td>
                <td class="col-sm-2">{{$store->created_at}}</td>
                <td class="col-sm-1">{{$store->state_label}}</td>
                <td class="col-sm-2">
                    <a href="{{ URL::route('showStore', ['idStore' => $store->id]) }}" class="btn btn-secondary btn-square m-2" type="button"><i class="fa fa-eye" style="color:white" aria-hidden="true"></i></a>
                    <a href="#modal-confirmationApprove" class="btn btn-success btn-square m-2" type="button"><i class="fa fa-check" style="color:white" aria-hidden="true"></i></a>
                    <a href="#modal-confirmationRefuse" class="btn btn-danger btn-square m-2" type="button"><i class="fa fa-times" style="color:white" aria-hidden="true"></i></a>
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
                <a href="{{URL::route('approveStore', ['idStore' => $store->id, 'idUser' => $user->id])}}" class="btn btn-success" role="button">Approuver</a>
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
                <a href="{{URL::route('refuseStore', ['idStore' => $store->id, 'idUser' => $user->id])}}" class="btn btn-success" role="button">Refuser</a>
            </div>
        </div>
    </div>
</div>
@endif


@endsection
