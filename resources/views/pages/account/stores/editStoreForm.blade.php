@extends('layouts.app')

@section('content')

<div class="card p-0">
    <div class="d-flex text-center">
        <a href="{{ route('statsStore', ['idStore' => $store->id])}}" class="font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto">Statistique</a>
        <h2 class="font-size-22 w-half py-5 m-0">
            Modifier
        </h2>
    </div>
    <div class="content">
        @include('components.store-form')
    </div>

</div>
@endsection
