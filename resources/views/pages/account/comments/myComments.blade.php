@extends('layouts.app')

@section('content')

<div class="card p-0 m-0 m-sm-10">
    <div class="d-flex text-center">
        <h2 class="font-size-22 w-half py-5 m-0 flex-shrink-1">
            Mes avis
        </h2>
        <a href="{{ route('addComments') }}" class="w-full font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto">Ajouter un avis</a>
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
                    <th>Commerce</th>
                    <th class="d-none d-sm-table-cell">Note</th>
                    <th class="d-none d-md-table-cell">Commentaire</th>
                    <th class="d-none d-lg-table-cell">Date</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->store->name}}</td>
                    <td class="d-none d-sm-table-cell">{{round($comment->note, 0)}} / 5</td>
                    <td class="d-none d-md-table-cell">{{Str::limit($comment->comment, 30, '...')}}</td>
                    <td class="d-none d-lg-table-cell">{{$comment->updated_at->format('d-m-Y')}}</td>
                    <td class="text-right">
                        <div class="dropdown with-arrow">
                            <button class="btn btn-secondary btn-square m-2" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-eye text-white" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu w-200 w-sm-250 w-md-300 dropdown-menu-right" aria-labelledby="confirmer la supprission du commentaire">
                                <div class="dropdown-content p-5 p-sm-10">
                                    <p>Avis sur <b>{{$comment->store->name}}</b></p>
                                <form action="{{ route('editComment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$comment->id}}">
                                    <div class="form-group">
                                        <label class="required">Note</label>
                                        <div class="note font-size-22 d-flex flex-row-reverse justify-content-end">
                                            <input class="d-none" type="radio" name="note" value="5" id="5-{{$comment->id}}" {{$comment->note == 5 ? 'checked': ''}}>
                                            <label for="5-{{$comment->id}}"><i class="fa fa-star"></i></label>
                                            <input class="d-none" type="radio" name="note" value="4" id="4-{{$comment->id}}" {{$comment->note == 4 ? 'checked': ''}}>
                                            <label for="4-{{$comment->id}}"><i class="fa fa-star"></i></label>
                                            <input class="d-none" type="radio" name="note" value="3" id="3-{{$comment->id}}" {{$comment->note == 3 ? 'checked': ''}}>
                                            <label for="3-{{$comment->id}}"><i class="fa fa-star"></i></label>
                                            <input class="d-none" type="radio" name="note" value="2" id="2-{{$comment->id}}" {{$comment->note == 2 ? 'checked': ''}}>
                                            <label for="2-{{$comment->id}}"><i class="fa fa-star"></i></label>
                                            <input class="d-none" type="radio" name="note" value="1" id="1-{{$comment->id}}" {{$comment->note == 1 ? 'checked': ''}}>
                                            <label for="1-{{$comment->id}}"><i class="fa fa-star"></i></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="comment">Commentaire</label>
                                        <textarea class="form-control" id="comment" name="comment">{{$comment->comment}}</textarea>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Modifier"/>
                                </form>
                            </div>
                            </div>
                        </div>
                        <div class="dropdown with-arrow">
                            <button class="btn btn-danger btn-square m-2" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="confirmer la supprission du commentaire">
                                <p>Voulez vous supprimer votre avis sur <b>{{$comment->store->name}}</b> ?</p>
                                <form action="{{ route('deleteComment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$comment->id}}">
                                    <input type="submit" class="btn btn-danger" value="Supprimer"/>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endForeach
            </tbody>
        </table>
        <div class="text-center">{{ $comments->links() }}</div>
        <style>
            .note>input:checked~label>i {
                color: var(--secondary-color);
            }
        </style>


@endsection
