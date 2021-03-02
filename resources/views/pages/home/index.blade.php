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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/mapScript.js')}}" defer></script>
    <style>
        #map {
            height: 100%;
            z-index: 1;
        }

        #inputCity:focus + .auto-comp {
            display: block !important;
        }

        .auto-comp:hover {
            display: block !important;
        }

        #store-list {
            z-index:81;
            margin-top:150px;
        }

        #store-list>li {
            list-style: none;
        }

        .info-store-list:hover {
            background-color:var(--dark-color-light)!important;
            opacity: 80%;
            cursor:pointer;
        }

        .dark-mode .info-store-list:hover {
            background-color:var(--dark-color)!important;
            opacity:80%;
            cursor:pointer;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #store-list::-webkit-scrollbar {
        display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #store-list {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
        }

        .cat-btn {
            height: var(--large-button-height);
        }
        .card{
            margin-left: 0 !important;
            margin-right: 20px !important;
        }
        .comments{
            width: 90%;
            height: 300px;
        }
        .leaflet-left{
            left: 95% !important;
            top: 35px !important;
        }

    </style>
</head>

<body data-set-preferred-mode-onload="true" class="with-custom-webkit-scrollbars with-custom-css-scrollbars">
    {{-- @{{(categoryFilter || categorySelected || 'Catégories').substring(0,16)}} --}}

    <div id="app" class="page-wrapper with-navbar">
        @include('layouts.home.navigation')
        <div class="content-wrapper d-flex flex-column pb-10">
            <div class="input-group justify-content-center input-group-lg mt-10">
                <div class="input-group-prepend dropdown cat-btn">
                    <button class="btn w-150 w-sm-200 px-0 btn-success overflow-hidden" data-toggle="dropdown" type="button" id="dropdown-toggle-btn-1" aria-haspopup="true" aria-expanded="false">
                        @{{categoryFilter || categorySelected || 'Catégories'}}<i class="fa fa-angle-down ml-5" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu w-350 w-sm-400" aria-labelledby="dropdown-toggle-btn-1">
                        @include('components.categorie')
                    </div>
                </div>
                <div class="form-group position-relative w-200 w-sm-350 mw-full">
                    <input v-model="querySearch" v-on:keyup="autoComplete" v-on:focus="autoComplete" type="text" id="inputCity" class="form-control form-control-lg rounded-0 rounded-right p-0 px-sm-5" name="inputCity" placeholder="Rechercher dans Localio" autocomplete="new-password">
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
            </div>

            <div id="map" class="mx-5 mx-sm-10">

            </div>
            <!-- Paneau gauche avec les différents commerces -->
            <div  id="store-list" class="bg-transparent verflow-x-hidden overflow-y-scroll w-150 w-sm-300 h-400 position-absolute ml-20 d-none d-sm-block">
                    <li class="d-flex flex-column" v-for="store in allStoreOnMap">
                        <div :id="'list-store-'+store.id" class="info-store-list bg-light-lm bg-dark-dm rounded p-sm-4 p-md-10">
                            <p class="text-center text-dark-lm text-white-dm"><span class="font-weight-bold">@{{store.name}}</span></p>
                            <p class="text-center text-dark-lm text-white-dm">@{{store.category}}</p>
                        </div>
                    </li>
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
                        <div class="row">
                            <div class="col-5">
                                <div style="height: 350px; width: 90%; background-color: grey"></div>
                                <h2>Commentaires</h2>
                                <div class="overflow-auto comments">
                                    @include('components.comment')
                                </div>
                            </div>
                            <div class="col-7">
                                <h2 class="content-title">@{{storeSelected.name}}</h2>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="checkbox-favoris" :value="storeSelected.id" v-model="myFavorites">
                                    <label for="checkbox-favoris">Favoris</label>
                                </div>
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
        </div>


    </div>
    <script>
        var categories = @json($categories);
        var myFavorites = @json($favorites);
        var idUser = @json($id_user);
    </script>

</body>

</html>
