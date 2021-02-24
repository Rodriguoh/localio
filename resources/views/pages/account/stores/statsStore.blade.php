@extends('layouts.app')

@section('content')

<div class="card p-0">
    <div class="d-flex text-center">
        <h2 class="font-size-22 w-half py-5 m-0">
            Statistique
        </h2>
        <a href="{{ route('createStore', ['idStore' => $store->id])}}" class="font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto">Modifier</a>
    </div>
    <div class="content">

    </div>

</div>
@endsection
