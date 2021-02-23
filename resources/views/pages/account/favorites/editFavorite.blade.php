@extends('layouts.app')

@section('content')
<div class="card m-0">
    <div class="d-flex justify-content-between">
        <a class="btn btn-square mb-20" href="{{ URL::previous() }}" type="button">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </a>
        <form action="{{route('deleteFavorite')}}" method="POST" onsubmit="return deleteFavorite()">
            @csrf
            <input type="hidden" name="id" value="{{$store->id}}">
            <input class="btn btn-danger" type="submit" value="Supprimer des favoris">
        </form>
    </div>

    <h1 class="card-title">{{$store->name}}</h1>
    <x-infos-store :store="$store" />

</div>

<script>
    function deleteFavorite() {
        localStorage.setItem('myFavorites',
        JSON.stringify(
            [
                ...JSON.parse(localStorage.getItem('myFavorites'))?.filter(fav => fav != @json($store->id))
            ]
            ));
        return true;
    }
</script>


@endsection
