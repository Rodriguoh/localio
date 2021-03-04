@extends('layouts.app')

@section('content')

    <div class="card">
        <h1 class="card-title">Avis signalés</h1>
        @if(isset($comments) && $comments->count() > 0)
            <table class="table table-striped">
                <thead>
                <tr class="d-flex">
                    <th class="col-sm-1">Commerce</th>
                    <th class="col-sm-2">Note</th>
                    <th class="col-sm-4">Avis</th>
                    <th class="col-sm-2">Date d'ajout</th>
                    <th class="col-sm-1">Auteur</th>
                    <th class="col-sm-2">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($comments as $comment)
                    <tr class="d-flex">
                        <td class="col-sm-1">{{$comment->store->name}}</td>
                        <td class="col-sm-2">{{$comment->note}}</td>
                        <td class="col-sm-4">{{$comment->comment}}</td>
                        <td class="col-sm-2">{{$comment->updated_at}}</td>
                        <td class="col-sm-1">{{$comment->user->firstname}} {{$comment->user->lastname}}</td>
                        <td class="col-sm-2">
                            <a href="" class="btn btn-success btn-square m-2" type="button"><i class="fa fa-check" style="color:white" aria-hidden="true"></i></a>
                            <a href="" class="btn btn-danger btn-square m-2" type="button"><i class="fa fa-times" style="color:white" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Il n'y a actuellement aucun avi signalé</p>
        @endif

    </div>
@endsection
