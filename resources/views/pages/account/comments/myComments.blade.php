@extends('layouts.app')

@section('content')

<div class="card p-0">
    <div class="d-flex text-center">
        <h2 class="font-size-22 w-half py-5 m-0">
            Mes avis
        </h2>
        <a href="{{ URL::previous() }}" class="font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto">Ajouter un avis</a>
    </div>
    <div class="content">
        @if (session('successAdd'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successAdd')}}</h4>
        </div>
        @endif
        @if (session('successDelete'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{session('successDelete')}}</h4>
        </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Commerce</th>
                    <th class="d-none d-sm-table-cell">Note</th>
                    <th class="d-none d-sm-table-cell">Date</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->store->name}}</td>
                    <td class="d-none d-sm-table-cell">{{$comment->note}}</td>
                    <td class="d-none d-sm-table-cell">{{$comment->created_at}}</td>
                    <td class="text-right"><a href="{{ URL::previous() }}" class="btn">Consulter</a></td>
                </tr>
            @endForeach
            </tbody>
        </table>
        <div class="text-center">{{ $comments->links() }}</div>



@endsection
