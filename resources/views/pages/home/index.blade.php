<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="{{ asset('js/leaflet-providers.js') }}" defer></script>
    <script src="{{ asset('js/leaflet.markercluster.js') }}" defer></script>
    {{-- MarkerCluster CSS --}}
    <link rel="stylesheet" href="{{ asset('css/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/MarkerCluster.Default.css') }}">

<<<<<<< HEAD
    {{-- FontAwesome CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    {{-- Dashicons CSS --}}
    <link href="//s.w.org/wp-includes/css/dashicons.css?20150710" rel="stylesheet" type="text/css">
    {{-- VueJS --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js" defer></script>
    {{-- mapScript.js --}}
    <script src="{{ asset('js/mapScript.js') }}" defer></script>
    {{-- Style CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body class="full-with">
    <div id="app">
        <nav v-show="!showStore">
            <div class="logo">
                <img src="{{ asset('img/logo_inline-clair.svg') }}" alt="logo de click and collect">
            </div>
            <div v-on:click="mobileMenu" class="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul class="nav-links">
                <li><a class="linkMenu" href="{{ route('home') }}"><img
                            src="{{ asset('img/icons/fa-home.svg') }}">Accueil</a></li>
                <li><a class="linkMenu" href="{{ route('homeAccount') }}"><img
                            src="{{ asset('img/icons/fa-login.svg') }}">Se connecter</a></li>
                <li><a href="#0" class="btn-color btn-secondary btn-xs">Aide</a></li>
            </ul>
        </nav>

        <div class="margin-constraint" v-show="!showStore">
            <div class="useful-width">
                <div class="header">
                    <div class="home-col-1">
                        <div class="illustration_home">
                            <img src="{{ asset('img/illustrations/home_car.svg') }}">
                        </div>
                    </div>
                    <div class="home-col-2">
                        <h1>Avec Localio le click and drive n’a jamais été aussi simple.</h1>
                        <p>Recherchez des magasins de proximité proposant le Click and Collect facilement avec Localio.
                            Consultez et commandez vos produits en ligne pour ensuite retirer les articles à l’heure que
                            vous souhaitez.</p>
                        <div class="research">
                            <div class="input-group-search">
                                <button v-on:change="refreshMapView" v-on:click="filters_isOpen = !filters_isOpen"
                                    class="button-input-filter"><img class="icon-menu-filter"
                                        src="{{ asset('img/icons/input-menu-filter.svg') }}"></button>
                                <input id="inputCity" v-model="querySearch" v-on:keyup="autoComplete"
                                    v-on:focus="filters_isOpen = false" type="text"
                                    placeholder="Une ville ou un nom de commerce">
                                <button class="button-input-search"><img class="icon-search"
                                        src="{{ asset('img/icons/input-search.svg') }}"></button>
                            </div>
                            <template v-if="querySearch.length > 0 && filters_isOpen == false">
                                <div class="research-propositions">
                                    <template v-if="resultsQueryCity.length > 0">
                                        <div v-for="city in computedResultsQueryCity"
                                            v-on:click="setViewMap(city.geometry.coordinates[1],city.geometry.coordinates[0])"
                                            class="research-proposition-link">
                                            <span class="mark">&nbsp;</span>
                                            <div class="icon"><img
                                                    src="{{ asset('img/icons/fa-building-solid.svg') }}">
                                            </div>
                                            <div class="title"> @{{ city . properties . nom }}</div>
                                            <div class="category">ville</div>
                                        </div>
                                    </template>

                                    <template v-if="resultsQueryStore.length > 0">
                                        <div v-for="store in computedResultsQueryStore"
                                            v-on:click="setViewMap(store.latnlg.lat, store.latnlg.lng)"
                                            class="research-proposition-link">
                                            <span class="mark">&nbsp;</span>
                                            <div class="icon"><img
                                                    src="{{ asset('img/icons/fa-shopping-basket-solid.svg') }}">
                                            </div>
                                            <div class="title"> @{{ store . name }}</div>
                                            <div class="category">commerce</div>
                                        </div>
                                    </template>
                                    <template v-if="resultsQueryCity.length < 1 && resultsQueryStore.length < 1">
                                        <div style="display:flex; align-items: center; height: 40px; ">
                                            <span style="margin: 0 auto; font-size:14px">Oops, il n'y a aucun
                                                résultat</span>
                                        </div>
                                    </template>

                                </div>
                            </template>

                            <div v-show="filters_isOpen">
                                <div class="research-filter">
                                    <div class="filters">
                                        <div class="research-filter-category">
                                            <p class="category">Quelle catégorie recherchez vous ?</p>
                                            <div class="buttons">
                                                <input type="radio" v-on:change="refreshMapView" value="" id="all"
                                                    name="categorie" v-model="categorySelected">
                                                <label for="all" class="btn btn-s btn-r8"
                                                    :class="[categorySelected == '' ? 'btn-color btn-secondary': 'btn-white']">voir
                                                    tout</label>
                                                <template v-for="cat in mainCat">
                                                    <input :id="cat.label" v-on:change="refreshMapView" type="radio"
                                                        name="categorie" :value="cat.label" v-model="categorySelected"
                                                        v-on:click="categoryFilter = ''">
                                                    <label :for="cat.label" class="btn btn-s btn-r8"
                                                        :class="[categorySelected == cat.label ? 'btn-color btn-secondary': 'btn-white']">@{{ cat . label }}</label>
                                                </template>
                                            </div>


                                        </div>
                                        <template v-if="categorySelected !== ''">
                                            <div class="research-filter-subcategory">
                                                <p class="subcategory">Besoin de plus de précision ?</p>
                                                <div class="buttons">
                                                    <template v-for="cat in mainCat">
                                                        <template v-for="sub in cat?.child">
                                                            <input :id="sub.id" v-on:change="refreshMapView"
                                                                v-model="categoryFilter" :value="sub.label" type="radio"
                                                                name="categorie">
                                                            <label class="btn btn-s btn-r8"
                                                                v-show="categorySelected == cat.label" :for="sub.id"
                                                                :class="[categoryFilter == sub.label ? 'btn-color btn-secondary': 'btn-white']">@{{ sub . label }}</label>
                                                        </template>
                                                    </template>
                                                </div>
                                            </div>
                                        </template>

                                        <div>
                                        </div>
                                        <button v-on:click="filters_isOpen = false;"
                                            onClick="document.querySelector('#map').scrollIntoView();"
                                            class="btn btn-s btn-action btn-r12 btn-py3">Voir</button>
                                        <button v-on:click="resetFilters"
                                            class="btn btn-color btn-secondary btn-xs btn-resetFilters">Reinitialiser</button>
                                    </div>

                                </div>
                            </div>

                        </div>
=======
    <!-- Halfmoon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">

    <!-- BOOTSTRAP DEV  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="stylesheet" href="{{ asset('css/MarkerCluster.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/MarkerCluster.Default.css')}}"/>
    <link rel="shortcut icon" href="#">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/leaflet-providers.js')}}" defer></script>
    <script src="{{ asset('js/mapScript.js')}}" defer></script>
    <script src="{{ asset('js/leaflet.markercluster.js')}}" defer></script>
    {{-- GOOGLE --}}
    <meta name="google-site-verification" content="tTLLOaNjWOL2DP1xxPXA1B6z06Z308qj5ps-AauIvBc" />
    
    <style>
        #map {
            height: 100%;
            z-index: 1;
        }

        #inputCity:focus+.auto-comp {
            display: block !important;
        }

        .auto-comp:hover {
            display: block !important;
        }

        #store-list {
            z-index: 81;
            margin-top: 150px;
        }

        @media screen and (min-width:992px) {
            #store-list {
                margin-top: 180px;
            }
        }

        @media (max-width: 768px) {

            .leaflet-left {
                display: none;
            }

        }

        #store-list>li {
            list-style: none;
        }

        .info-store-list:hover {
            background-color: var(--dark-color-light) !important;
            opacity: 80%;
            cursor: pointer;
        }

        .dark-mode .info-store-list:hover {
            background-color: var(--dark-color) !important;
            opacity: 80%;
            cursor: pointer;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #store-list::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #store-list {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .cat-btn {
            height: var(--large-button-height);
        }

        .card {
            margin-left: 0 !important;
            margin-right: 20px !important;
        }

        .comments {
            width: 90%;
            height: 300px;
        }

        .leaflet-left {
            left: 95% !important;
            top: 35px !important;
        }

        #storeDescription h1 {
            font-size:2rem;
            font-weight: 500;
            text-align:center;
        }

        #storeDescription h2 {
            font-size:1.8rem;
            font-weight: 500;
            text-align:center;
        }

        #storeDescription h3 {
            font-size:1.6rem;
            font-weight: 500;
            text-align:center;
        }

        @media (max-width: 768px) {

            .leaflet-left{
                display: none;
            }
        }
    </style>
</head>
>>>>>>> main

                    </div>
                </div>

            </div>
        </div>

        <div class="map-and-list" v-show="!showStore">
            <div id="map">

            </div>
<<<<<<< HEAD
            <template v-if="allStoreOnMap.length > 0">
                <div class="stores-list">
                    <template v-for="store in computedAllStoreOnMap">
                        <div class="element-list" :id="'list-store-'+store.id">
                            <div class="img-element-list">
                                <img src="{{ asset('img/photos/exemple-image-store-2.jpeg') }}">
                            </div>
                            <div class="info-element-list">
                                <p>@{{ store . name }}</p>
                                <div>
                                    <span class="description-veryshort">@{{ store . short_description }}.</span>
                                    <div class="note">
                                        <span>@{{ Math . round(store . avg_note * 100) / 100 }}</span>
                                        <span><img src="{{ asset('img/icons/star.svg') }}"><span
                                                class="stars-word">/5</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

        </div>


        <div class="modal-store" style="display:none" v-show="showStore">
            <a class="close" v-on:click="maskModalStore"></a>
            <div class="header-modal-store">
                <div class="img-store"><img src="{{ asset('img/photos/exemple-image-store-3.jpg') }}"></div>
                <div class="margin-constraint">
                    <div class="useful-width">
                        <div class="info-store">
                            <h3>@{{ selectedStore ? selectedStore . name : '' }}</h3>
                            <div class="stars-and-notes">
                                <div class="note-store">
                                    <span class="icon-star"><img src="{{ asset('img/icons/star.svg') }}"></span>
                                    <span class="icon-star"><img src="{{ asset('img/icons/star.svg') }}"></span>
                                    <span class="icon-star"><img src="{{ asset('img/icons/star.svg') }}"></span>
                                    <span class="icon-star"><img src="{{ asset('img/icons/star.svg') }}"></span>
                                    <span class="icon-star disable"><img
                                            src="{{ asset('img/icons/star.svg') }}"></span>
                                </div>
                                <div class="total-notes"><span>X</span> avis</div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
            <div class="main-modal-store">
                <div class="margin-constraint">
                    <div class="useful-width">
                        <div class="comments-modal-store">
                            <h3></h3>
                            @include('components.comments')

                        </div>

                        <div class="description-modal-store">
                            <div class="title-favorite">
                                <h3> Description</h3>
                                <div class="icon-favorite">
                                    <div class="fav-btn">
                                        <input type="checkbox" id="checkbox-favoris" :value="selectedStore.id"
                                            v-model="myFavorites">
                                        <label for="checkbox-favoris"
                                            :class="[myFavorites.includes(selectedStore.id) ? 'favme dashicons dashicons-heart active' : 'favme dashicons dashicons-heart']"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- <p>@{{ selectedStore ? selectedStore . description : '' }}</p> -->
                            <div class="content-description">
                                <p id="storeDescription"></p> <!-- desciption add with getStore function -->
                            </div>
                            <div class="info-contact-store">
                                <div class="part">
                                    <div class="element-info-contact-store">
                                        <div><i class="fas fa-envelope"></i></div>
                                        @{{ selectedStore ? selectedStore . mail : '' }}
=======

            <!-- Paneau gauche avec les différents commerces -->
            <div id="store-list" class="bg-transparent verflow-x-hidden overflow-y-scroll w-150 w-sm-250 h-400 position-absolute ml-20 d-none d-sm-block">
                <li class="d-flex flex-column" v-for="store in allStoreOnMap">
                    <div :id="'list-store-'+store.id" class="row info-store-list bg-light-lm bg-dark-dm rounded p-sm-4 p-md-10">
                        <div class="row col-6">
                            <div v-if="store.thumbnails">
                                <img :src="store.thumbnails" class="img-fluid rounded w-sm-100 h-sm-100 col-6" alt="">
                            </div>
                        </div>
                        <div class="d-flex flex-column col-6">
                            <p class="text-left text-dark-lm text-white-dm mt-0"><span class="font-weight-bold">@{{store.name}}</span></p>
                            <p v-if="store.avg_note" class="text-lefttext-dark-lm text-white-dm mt-0">@{{ parseInt(store.avg_note)  }} / 5</p>
                            <p class="text-left text-dark-lm text-white-dm mt-0">@{{store.category}}</p>
                        </div>
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
                    <div class="container-sm d-flex flex-column">
                        <div class="row">
                            <div class="col-md-5 ml-20">
                                <!-- Bug Img sur Heroku -->
                                <div v-if="storeSelected.thumbnails">
                                    <!-- Voir style img -->
                                    <img class="img-fluid rounded w-200 w-sm-350" :src="storeSelected.thumbnails" alt="">
                                </div>
                                <template v-if="comments?.length > 0">
                                    <h2 class="content-title">Commentaires :</h2>
                                    <div class="overflow-auto comments">
                                        @include('components.comment')
                                    </div>
                                </template>
                            </div>
                            <div class="col-md-6 order-first">
                                <h2 class="content-title">@{{storeSelected.name}}</h2>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="checkbox-favoris" :value="storeSelected.id" v-model="myFavorites">
                                    <label for="checkbox-favoris">Favoris</label>
                                </div>
                                <div class="m-auto text-justify">
                                    <div class="my-10">
                                        <p><span class="font-weight-medium">Mail :</span> @{{storeSelected?.mail}}</p>
                                        <p><span class="font-weight-medium">Téléphone :</span> @{{storeSelected?.phone}}</p>
                                        <p><span class="font-weight-medium">Site internet :</span> @{{storeSelected?.url}}</p>
                                    </div>
                                    <div class="my-10">
                                        <p><span class="font-weight-medium">Adresse :</span> @{{storeSelected?.adresse?.number}}, @{{storeSelected?.adresse?.street}}, @{{storeSelected?.adresse?.city}}, @{{storeSelected?.adresse?.ZIPCode}} </p>
>>>>>>> main
                                    </div>
                                    <div class="element-info-contact-store">
                                        <div><i class="fas fa-mouse-pointer"></i></div>
                                        @{{ selectedStore ? selectedStore . url : '' }}
                                    </div>
                                    <div class="element-info-contact-store">
                                        <div><i class="fas fa-map-marker-alt"></i></div>
                                        @{{ selectedStore ? `${selectedStore . adresse . number != undefined ? selectedStore . adresse . number : ''} ${selectedStore . adresse . street != undefined ? selectedStore . adresse . street : ''}, ${selectedStore . adresse . ZIPcode != undefined ? selectedStore . adresse . ZIPcode : ''} ${selectedStore . adresse . city != undefined ? selectedStore . adresse . city : ''}` : '' }}
                                    </div>
<<<<<<< HEAD
                                </div>
                                <div class="part">
                                    <div class="element-info-contact-store">
                                        <div><i class="fas fa-phone"></i></div>
                                        @{{ selectedStore ? selectedStore . phone : '' }}
=======

                                    <div class="my-10">
                                        <span class="font-weight-medium">Description :</span>
                                        <p id="storeDescription"></p> <!-- desciption add with getStore function -->
>>>>>>> main
                                    </div>
                                    <div class="element-info-contact-store">
                                        <div><i class="fas fa-biking"></i></div>
                                        @{{ selectedStore . isDelivering ? 'Oui' : 'Non' }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <footer>
            </footer>

        </div>




        <script type="application/javascript">
            var categories = @json($categories);
            var myFavorites = @json($favorites);
            var idUser = @json($id_user);

        </script>
</body>

</html>
