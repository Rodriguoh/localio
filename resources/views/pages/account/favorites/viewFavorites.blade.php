@extends('layouts.app')

@section('content')
<div class="card m-0 px-10">
    <h1 class="card-title">Mes commerces favoris</h1>
    @if (session('successDelete'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successDelete')}}</h4>
        </div>
    @endif
    <div class="container-fluid">
        @foreach($favorites as $favorite)
        @if($loop->index % 2 == 0)
        <div class="row row-eq-spacing-md">
        @endif
            <div class="col-md-6">
                <div class="card m-0 bg-dark-light-dm">
                <h2 class="card-title mb-5">
                    {{$favorite->name}}

                  </h2>
                  <span class="badge badge-primary">{{$favorite->category->label}}</span>
                  <p>
                      {{$favorite->short_description}}
                  </p>
                  <div class="text-right">
                      <a class="btn" href="{{route('editFavorite', ['idStore'=> $favorite->id])}}">Détails</a>
                  </div>
                </div>
            </div>
            @if($loop->index % 2 == 1)
        </div>
        @endif
        @endforeach
        @if($favorites)
            <p>Vous n'avez aucun commerce dans vos favoris !</p>
        @endif
    </div>
    <div class="text-center">{{ $favorites->links() }}</div>
</div>

@endsection
