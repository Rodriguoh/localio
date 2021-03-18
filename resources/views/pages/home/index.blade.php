<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
     <script src="{{ asset('js/leaflet-providers.js')}}" defer></script>
    {{-- FontAwesome CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">
    {{-- VueJS --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js" defer></script>
    {{-- mapScript.js --}}
    <script src="{{ asset('js/mapScript.js')}}" defer></script>
    {{-- Style CSS --}}
   
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body class="full-with">
    <div id="app">
        <nav>
            <div class="logo">
                <img src="{{asset('img/logo_inline-clair.svg')}}" alt="logo de click and collect">
            </div>
            <div v-on:click="mobileMenu" class="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul class="nav-links">
                <li><a class="linkMenu" href="#0"><img src="{{asset('img/icons/fa-home.svg')}}">Accueil</a></li>
                <li><a class="linkMenu" href="#0"><img src="{{asset('img/icons/fa-login.svg')}}">Se connecter</a></li>
                <li><a href="#0" class="btn-color btn-secondary btn-xs">Aide</a></li>
            </ul>
        </nav>

        <div class="margin-constraint">
            <div class="useful-width">
                <div class="header">
                    <div class="home-col-1">
                        <div class="illustration_home">
                            <img src="{{asset('img/illustrations/home_car.svg')}}">
                        </div>
                    </div>
                    <div class="home-col-2">
                        <h1>Avec Localio le click and drive n’a jamais été aussi simple.</h1>
                        <p>Recherchez des magasins de proximité proposant le Click and Collect facilement avec Localio. Consultez et commandez vos produits en ligne pour ensuite retirer les articles à l’heure que vous souhaitez.</p>

                        <div class="research">
                            <div class="input-group-search">
                                <button v-on:click="filters_isOpen = !filters_isOpen" class="button-input-filter"><img class="icon-menu-filter" src="{{asset('img/icons/input-menu-filter.svg')}}"></button>
                                <input id="inputCity" v-model="querySearch" v-on:keyup="autoComplete" v-on:focus="filters_isOpen = false" type="text" placeholder="Une ville ou un nom de commerce">
                                <button class="button-input-search"><img class="icon-search" src="{{asset('img/icons/input-search.svg')}}"></button>

                            </div>
                            <template v-if="querySearch.length > 0 && filters_isOpen == false">
                                <div class="research-propositions">
                                    <template v-if="resultsQueryCity.length > 0">
                                        <div v-for="city in computedResultsQueryCity" v-on:click="setViewMap(city.geometry.coordinates[1],city.geometry.coordinates[0])" class="research-proposition-link">
                                            <span class="mark">&nbsp;</span>
                                            <div class="icon"><img src="{{asset('img/icons/fa-building-solid.svg')}}"></div>
                                            <div class="title"> @{{ city.properties.nom }}</div>
                                            <div class="category">ville</div>
                                        </div>
                                    </template>

                                    <template v-if="resultsQueryStore.length > 0">
                                        <div v-for="store in computedResultsQueryStore" v-on:click="setViewMap(store.latnlg.lat, store.latnlg.lng)" class="research-proposition-link">
                                            <span class="mark">&nbsp;</span>
                                            <div class="icon"><img src="{{asset('img/icons/fa-shopping-basket-solid.svg')}}"></div>
                                            <div class="title"> @{{ store.name }}</div>
                                            <div class="category">commerce</div>
                                        </div>
                                    </template>
                                    <template v-if="resultsQueryCity.length < 1 && resultsQueryStore.length < 1">
                                        <div style="display:flex; align-items: center; height: 40px; ">
                                            <span style="margin: 0 auto; font-size:14px">Oops, il n'y a aucun résultat</span>
                                        </div>
                                    </template>

                                </div>
                            </template>

                            <template v-if="filters_isOpen">
                                <div class="research-filter">
                                    <div class="filters">
                                        <div class="research-filter-category">
                                            <p class="category">Quelle catégorie recherchez vous ?</p>
                                            <div class="buttons">
                                                <input type="radio" value="" id="tout" name="categorie" v-model="categorySelected">
                                                <label for="tout" class="btn btn-s btn-r8" :class="[categorySelected == '' ? 'btn-color btn-secondary': 'btn-white']">voir tout</label>
                                                <template v-for="cat in mainCat">
                                                    <input :id="cat.label" type="radio" name="categorie" :value="cat.label" v-model="categorySelected" v-on:click="categoryFilter = ''">
                                                    <label :for="cat.label" class="btn btn-s btn-r8" :class="[categorySelected == cat.label ? 'btn-color btn-secondary': 'btn-white']">@{{ cat.label }}</label>
                                                </template>
                                            </div>


                                        </div>
                                        <template v-if="categorySelected !== ''">
                                            <div class="research-filter-subcategory">
                                                <p class="subcategory">Besoin de plus de précision ?</p>
                                                <div class="buttons">
                                                    <template v-for="cat in mainCat">
                                                        <template v-for="sub in cat?.child">
                                                            <input :id="sub.id" type="radio" name="categorie" :value="sub.label" v-model="categoryFilter">
                                                            <label class="btn btn-s btn-r8" v-show="categorySelected == cat.label" :for="sub.id" :class="[categoryFilter == sub.label ? 'btn-color btn-secondary': 'btn-white']">@{{ sub.label }}</label>
                                                        </template>
                                                    </template>
                                                </div>
                                            </div>
                                        </template>

                                        <div>
                                        </div>
                                        <button class="btn btn-s btn-action btn-r12">Appliquer</button>
                                    </div>

                                </div>
                            </template>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="map-and-list">
            <div id="map">

            </div>
            <template>
                <div class="stores-list">

                    <div class="element-list">
                        <div class="img-element-list">
                            <img src="{{asset('img/photos/exemple-image-store-2.jpeg')}}">
                        </div>
                        <div class="info-element-list">
                            <p>Sushi Place</p>
                            <div>
                                <span class="description-veryshort">If you’re offered a seat on a rocket ship, don’t ask what seat! Just get on.</span>
                                <div class="note">
                                    <span>5</span>
                                    <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;étoiles</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-list">
                        <div class="img-element-list">
                            <img src="{{asset('img/photos/exemple-image-store-2.jpeg')}}">
                        </div>
                        <div class="info-element-list">
                            <p>Sushi Place</p>
                            <div>
                                <span class="description-veryshort">If you’re offered a seat on a rocket ship, don’t ask what seat! Just get on.</span>
                                <div class="note">
                                    <span>5</span>
                                    <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;étoiles</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-list">
                        <div class="img-element-list">
                            <img src="{{asset('img/photos/exemple-image-store-2.jpeg')}}">
                        </div>
                        <div class="info-element-list">
                            <p>Sushi Place</p>
                            <div>
                                <span class="description-veryshort">If you’re offered a seat on a rocket ship, don’t ask what seat! Just get on.</span>
                                <div class="note">
                                    <span>5</span>
                                    <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;étoiles</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-list">
                        <div class="img-element-list">
                            <img src="{{asset('img/photos/exemple-image-store-2.jpeg')}}">
                        </div>
                        <div class="info-element-list">
                            <p>Sushi Place</p>
                            <div>
                                <span class="description-veryshort">If you’re offered a seat on a rocket ship, don’t ask what seat! Just get on.</span>
                                <div class="note">
                                    <span>5</span>
                                    <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;étoiles</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

        </div>
        <footer>
        </footer>

    </div>




    <script>
        var categories = @json($categories);
        var idUser = @json($id_user);

    </script>
</body>

</html>
