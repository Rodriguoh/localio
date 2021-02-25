@extends('layouts.app')

@section('content')

<!-- Commerçant -->
{{--  --}}
<div class="card m-0">
    <h2 class="card-title">
        Création d'un commerce
    </h2>
    @include('components.store-form')
</div>
@endsection
