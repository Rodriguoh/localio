@extends('layouts.app')

@section('content')
<div class="card">
    <h1 class="card-title">Store: {{$store->store_name}}</h1>
    <x-infos-store :store="$store"/>
</div>


@endsection
