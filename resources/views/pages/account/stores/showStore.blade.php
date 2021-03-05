@extends('layouts.app')

@section('content')
<div class="card">
    <a class="btn btn-square mb-20" href="{{ URL::previous() }}" type="button">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <h1 class="card-title">Store: {{$store->name}}</h1>
    <x-infos-store :store="$store" />

    <div class="content pt-10">
        @if($store->state->label == "pending")
        <a href="{{URL::route('approveStore', ['idStore' => $store->id])}}" class="btn btn-primary" type="button">Approuver</a>
        @elseif($store->state->label == "refused")
        <a href="{{URL::route('approveStore', ['idStore' => $store->id])}}" class="btn btn-primary" type="button">Approuver</a>
        @endif
        @if($store->state->label == "pending")
        <a href="{{URL::route('refuseStore', ['idStore' => $store->id])}}" class="btn btn-danger" type="button">Refuser</a>
        @elseif($store->state->label == "approved")
        <a href="{{URL::route('refuseStore', ['idStore' => $store->id])}}" class="btn btn-danger" type="button">Suspendre</a>
        @endif

    </div>
</div>


@endsection
