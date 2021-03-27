@extends('layouts.app')


@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />

<div class="card p-0">
    <div class="d-flex text-center">
        <h2 class="font-size-22 w-half py-5 m-0">
            Statistiques
        </h2>
        <a href="{{ route('createStore', ['idStore' => $store->id])}}" class="font-size-22 w-half btn py-5 rounded-0 shadow-none h-auto">Modifier</a>
    </div>
    <div class="content">
        <h1 class="content-title font-size-22">
            {{ $store->name}}
        </h1>
        <div class="row">
            <div class="col-sm-6">
                <p>Adresse : <span class="badge">{{ $store->number . ' ' . $store->street . ' ' . $store->city->name}}</span></p>
                <p>Code commentaire : <span class="badge">{{ $store->codeComment}}</span></p>
            </div>
            <div class="col-sm-6">
                <p>Etat : <span class="badge">{{ $store->state->label}}</span></p>
            </div>
        </div>

        <div class="row row-eq-spacing">
            <div class="col-12 col-md-4">
                <div class="card bg-dark-light-dm">
                    <h2 class="card-title">Commentaires</h2>
                    {{$store->comments->count()}}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark-light-dm">
                    <h2 class="card-title">Visites</h2>
                    {{$store->consultations->count()}}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark-light-dm">
                    <h2 class="card-title">Note moyenne</h2>
                    {{$store->comments->count() > 0 ? $store->comments->avg('note') . '/5' : 'Aucune note'}}
                </div>
            </div>
        </div>
        <canvas id="myChart" width="200" height="110"></canvas>
    </div>
    <script>
        var consultations = @json($consultations);
        var months = ["January","February","March","April","June", "July", "August", "September", "October", "November", "December"];
        var currentMonth = new Date().getMonth();
        var orderedMonth = months.slice(currentMonth-10).concat(months.slice(0,currentMonth+1));
        new Chart(document.getElementById('myChart'),
            {
                "type": "line",
                "data": {
                    "labels": orderedMonth,
                    "datasets": [
                        {
                            "label": "Nombre de visite",
                            "data": orderedMonth.map((month)=> {return consultations?.[month]}),
                            "fill": false,
                            "borderColor": "rgb(75, 192, 192)",
                            "lineTension": 0.1
                        }
                    ]
                }, "options": {}
            });
    </script>
@endsection
