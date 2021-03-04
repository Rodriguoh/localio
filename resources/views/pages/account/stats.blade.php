@extends('layouts.app')

@section('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />

<div class="card p-0">
    <h1 class="card-title m-10">Statistiques</h1>
        <div class="row row-eq-spacing">
            <div class="col-12 col-md-4">
                <div class="card bg-dark-light-dm">
                    <h2 class="card-title">Commentaires</h2>
                    {{$nbCommentaire}}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark-light-dm">
                    <h2 class="card-title">Visites</h2>
                    {{$nbConsultations}}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark-light-dm">
                    <h2 class="card-title">Utilisateurs</h2>
                    {{$nbUtilisateurs}}
                </div>
            </div>
        </div>
        <canvas id="myChart" width="300" height="100"></canvas>
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
