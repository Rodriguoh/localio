@extends('layouts.app')

@section('content')

<div class="card p-0 m-0 m-sm-10">
    <h1 class="m-10 card-title">
        @if(isset($categoryParrent))
        <a class="btn btn-square mb-20" href="{{ route('categories') }}" type="button">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </a>
            Sous catégories de {{$categoryParrent->label}}
        @else
            Les catégories
        @endif
    </h1>
    <div class="dropdown with-arrow">
        <button class="btn btn-success m-10" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
            Ajouter une @if(!isset($categoryParrent))
                            Categorie
                        @else
                            Sous-categorie
                        @endif
                        <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-left" aria-labelledby="confirmer la supprission du commentaire">
            <div class="dropdown-content p-5 p-sm-10">
            <form action="{{route('addCategory')}}" method="post">
                @csrf
                @if(isset($categoryParrent))
                <input type="hidden" name="category_id" value="{{$categoryParrent->id}}">
                @endif

                <div class="form-group">
                    <label class="required" for="label">Nom de la @if(!isset($categoryParrent))
                        Categorie
                    @else
                        Sous-categorie
                    @endif</label>
                    <input type="text" class="form-control" id="label" name="label">
                </div>
                <input type="submit" class="btn btn-success" value="Ajouter"/>
            </form>
        </div>
        </div>
    </div>
    <div class="content mx-0">
        @if (session('successAdd'))
        <div class="alert alert-success mx-10" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successAdd')}}</h4>
        </div>
        @endif
        @if (session('successDelete'))
        <div class="alert alert-success mx-10" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successDelete')}}</h4>
        </div>
        @endif
        @if (session('successEdit'))
        <div class="alert alert-success mx-10" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successEdit')}}</h4>
        </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    @if(!isset($categoryParrent))
                        <th>Categorie</th>
                    @else
                        <th>Sous-categorie</th>
                    @endif
                    @if(!isset($categoryParrent))
                        <th>Sous-categorie</th>
                    @endif

                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->label}}</td>
                    @if(!isset($categoryParrent))
                    <td>
                        <a class="btn btn-sm" href="{{ route('categories', ['category_id' => $category->id])}}">Modifier</a>
                    </td>
                    @endif
                    <td class="text-right">
                        <div class="dropdown with-arrow">
                            <button class="btn btn-secondary btn-square m-2" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-edit text-white" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-right" aria-labelledby="confirmer la supprission du commentaire">
                                <div class="dropdown-content p-5 p-sm-10">
                                <form action="{{route('editCategory')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                    <div class="form-group">
                                        <label class="required" for="label">Nom de catégorie</label>
                                        <input type="text" class="form-control" id="label" name="label" value="{{$category->label}}">
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Modifier"/>
                                </form>
                            </div>
                            </div>
                        </div>
                        @if(!$category->isUse())
                            <form action="{{route('deleteCategory')}}" class="d-inline-block" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$category->id}}">
                                <button type="submit" class="btn btn-danger btn-square m-2" value="Modifier"><i class="fa fa-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endForeach
            </tbody>
        </table>
        <div class="text-center">{{ $categories->links() }}</div>

@endsection
