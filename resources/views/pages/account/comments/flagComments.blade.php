@extends('layouts.app')

@section('content')

    <div class="card m-0 p-5 p-sm-10">
        <h1 class="card-title">Avis signalés</h1>
        @if(isset($comments) && $comments->count() > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="">Commerce</th>
                    <th class="">Note</th>
                    <th class="">Avis</th>
                    <th class="d-none d-md-table-cell">Date d'ajout</th>
                    <th class="d-none d-sm-table-cell">Auteur</th>
                    <th class="">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($comments as $comment)
                    <tr>
                        <td class="">{{$comment->store->name}}</td>
                        <td class="">{{$comment->note}}</td>
                        <td class="">{{$comment->comment}}</td>
                        <td class="d-none d-md-table-cell">{{$comment->updated_at}}</td>
                        <td class="d-none d-sm-table-cell">{{$comment->user->firstname}} {{$comment->user->lastname}}</td>
                        <td class="">
                            <a href="{{route('approveComment', ['idComment' => $comment->id])}}" class="btn btn-success btn-square m-2" type="button"><i class="fa fa-check" style="color:white" aria-hidden="true"></i></a>
                            <a href="{{route('refuseComment', ['idComment' => $comment->id])}}" class="btn btn-danger btn-square m-2" type="button"><i class="fa fa-times" style="color:white" aria-hidden="true"></i></a>
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
