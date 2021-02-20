@extends('layouts.app')

@section('content')
<div class="card">
    <a class="btn btn-square mb-20" href="{{ URL::previous() }}" type="button">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <h1 class="card-title">Store: {{$store->store_name}}</h1>
    <x-infos-store :store="$store" />
</div>


@endsection
