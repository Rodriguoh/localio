<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="css/main.css"> --}}

    <!-- Halfmoon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">

    <!-- BOOTSTRAP DEV  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="shortcut icon" href="#">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <style>
        #map {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        #inputCity:focus + .auto-comp {
            display: block !important;
        }

        .auto-comp:hover {
            display: block !important;
        }
    </style>
</head>

<body data-set-preferred-mode-onload="true">

    <div id="app" class="page-wrapper with-navbar">
        @include('layouts.home.navigation')
        <div class="content-wrapper">
            <div class="">
                <div class="form-group position-relative w-400 mw-full">
                    <input v-model="querySearch" v-on:keyup="autoComplete" v-on:focus="autoComplete" type="text" id="inputCity" class="form-control" name="inputCity" placeholder="Rechercher par le nom d'une ville" style="min-width: 300px;height: 40px;"  autocomplete="new-password">
                    <template v-if="resultsQueryCity.length > 0 || resultsQueryStore.length > 0">
                        <ul class="position-absolute z-10 text-dark-lm text-light-dm bg-dark-dm bg-light-lm w-full d-none auto-comp">

                            <li class="nav-link" v-for="city  in computedResultsQueryCity" v-on:click="setViewMap(city.geometry.coordinates[1],city.geometry.coordinates[0])">
                                <i class="fa fa-map-marker mr-5"></i><span class="font-weight-bold">@{{city.properties.nom}}</span>
                            </li>

                            <li class="nav-link" v-for="store in computedResultsQueryStore" v-on:click="setViewMap(store.latnlg.lat, store.latnlg.lng)">
                                <!--   -->
                                <i class="fa fa-shopping-basket mr-5"></i><span class="font-weight-bold">@{{store.name}}</span><span>@{{', '+store.city_name}}</span>
                            </li>
                        </ul>
                    </template>
                </div>
                @include('components.categorie')
            </div>
            <div id="map">
            </div>
        </div>


        <!-- Modal click on marker -->
        <div id="modal-store" class="modal modal-full ie-scroll-fix" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" role="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="container">
                        <h2 class="content-title">@{{storeSelected.name}}</h2>
                        <div class="m-auto text-justify">
                            <div class="my-10">
                                <p><span class="font-weight-medium">Mail :</span> @{{storeSelected?.mail}}</p>
                                <p><span class="font-weight-medium">Téléphone :</span>  @{{storeSelected?.phone}}</p>
                                <p><span class="font-weight-medium">Site internet :</span>  @{{storeSelected?.url}}</p>
                            </div>
                            <div class="my-10">
                                <p><span class="font-weight-medium">Adresse :</span> @{{storeSelected?.adresse?.number}}, @{{storeSelected?.adresse?.street}}, @{{storeSelected?.adresse?.city}}, @{{storeSelected?.adresse?.ZIPCode}}    </p>
                            </div>
                            <div class="my-10">
                                <p><span class="font-weight-medium">Catégorie :</span> @{{storeSelected?.category}}</p>
                            </div>
                            <div class="my-10">
                                <!-- <p><span class="font-weight-medium">Horraires :</span> @{{storeSelected?.openingHours}}</p>  -->
                            </div>

                            <div class="my-10">
                                <p> <span class="font-weight-medium">Description :</span> @{{storeSelected.description}}</p>
                            </div>

                            <div class="my-10">
                                <p><span class="font-weight-medium"> Livraison :</span> @{{storeSelected?.isDelivering ? 'Oui' : 'Non' }} </p>
                                <p><span class="font-weight-medium"> Condition de livraison :</span> @{{storeSelected?.conditionDelivery}}</p>
                            </div>

                            <div class="my-10">
                                <p><span class="font-weight-medium"> N° Siret :</span> @{{storeSelected?.SIRET}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Import VueJS via CDN pour la phase de dev --}}
    <!-- Halfmoon JS -->
    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>

    <!-- Optional. Required for modals to be dismissible by clicking on overlays, or pressing the [esc] key. -->
    <!-- <script src="path/to/halfmoon.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="js/mapScript.js"></script>

    {{-- @include('layouts.footer') --}}
</body>

</html>
