
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <!-- BOOTSTRAP DEV  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="shortcut icon" href="#">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <style>
        #map {
            width: 100%;
            height: 100vh;
            z-index:1;
        }

    </style>
</head>
<body>
    @include('layouts.navigation')
    <div id="app">
        <div class="">
            <input v-model="querySearch" v-on:keyup="autoComplete" type="text" id="inputCity" name="inputCity" placeholder="Rechercher par le nom d'une ville" style="min-width: 300px;height: 40px;">
            <template v-if="resultsQueryCity.length > 0 || resultsQueryStore.length > 0">
                <div class="panel-footer">

                    <button class="btn btn-primary" style="padding: 5px" v-for="city  in computedResultsQueryCity" v-on:click="setViewMap(city.geometry.coordinates[1],city.geometry.coordinates[0])">
                        @{{city.properties.nom}}
                    </button>

                    <button class="btn btn-secondary" style="padding: 5px" v-for="store in computedResultsQueryStore" v-on:click="setViewMap(store.latnlg.lat, store.latnlg.lng)">
                        <!--   -->
                        @{{store.name}}
                    </button>
                </div>
            </template>

        </div>
        <a id="scroll" href="#bottom">
            <img src="{{asset('img/arrow.svg')}}">
        </a>
        <div id="map">
        </div>
    </div>
    @include('layouts.footer')

    {{-- Import VueJS via CDN pour la phase de dev --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="js/mapScript.js"></script>
</body>
</html>
