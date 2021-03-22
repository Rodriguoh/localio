@extends('layouts.app')

@section('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />

<div class="card p-5 p-sm-10 m-0">
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
        <div class="row">
            <div class="col-md-6">
                <h2 class="card-title">Evolution du nombre de visite sur l'année</h2>
                <canvas id="myChart" width="200" height="110"></canvas>
            </div>
            <div class="col-md-6">
                <h2 class="card-title">Répartition des consultations par catégorie de commerce</h2>
                <canvas id="myChartByCat" width="200" height="110"></canvas>
            </div>
        </div>

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
    <script>
        const stringToColor = (string) =>  {
            var hash = 0;
            if (string.length === 0) return hash;
            for (var i = 0; i < string.length; i++) {
                hash = string.charCodeAt(i) + ((hash << 5) - hash);
                hash = hash & hash;
            }
            var rgb = [0, 0, 0];
            for (var i = 0; i < 3; i++) {
                var value = (hash >> (i * 8)) & 255;
                rgb[i] = value;
            }
            return `rgb(${rgb[0]}, ${rgb[1]}, ${rgb[2]})`;
        }
        var consultationsByCat = @json($consultationsByCat);
        console.log(consultationsByCat, consultationsByCat.map(cat => stringToColor(cat.label)), consultationsByCat.map(cat => cat.label))
        new Chart(document.getElementById('myChartByCat'), {
            'type': 'doughnut',
            'data':
                {
                    'labels': consultationsByCat.map(cat => cat.label),
                    'datasets': [
                                    {
                                        'label': 'Répartition des consultations par catégorie de commerce',
                                        'data': consultationsByCat.map(cat => cat['count(*)']),
                                        'backgroundColor': consultationsByCat.map(cat => stringToColor(cat.label))
                                    }
                    ]
                }

            ,
            'options': {}
        });

        //new Chart(document.getElementById("chartjs-4"),{"type":"doughnut","data":{"labels":["Red","Blue","Yellow"],"datasets":[{"label":"My First Dataset","data":[300,50,100],"backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]}]}});
    </script>


@endsection
