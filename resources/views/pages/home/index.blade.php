<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="css/main.css"> --}}



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="shortcut icon" href="#">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/mapScript.js')}}" defer></script>
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
                            <input type="text" value="Exemplio">
                            <button class="button-input-search"><img class="icon-search" src="{{asset('img/icons/input-search.svg')}}"></button>
                        </div>
                        <template v-if="filters_isOpen">
                            <div class="research-filter">
                                <div class="filters">
                                    <div class="research-filter-category">
                                        <p class="category">Quelle catégorie recherchez vous ?</p>
                                        <div class="buttons">
                                            <button class="btn btn-color btn-secondary btn-s btn-r8">Voir tout</button>
                                            <button class="btn btn-white btn-s btn-r8">Restaurant</button>
                                            <button class="btn btn-white btn-s  btn-r8">Alimentaire</button>
                                            <button class="btn btn-white btn-s  btn-r8">Culture</button>
                                            <button class="btn btn-white btn-s  btn-r8">Habits</button>
                                        </div>

                                    </div>
                                    <div class="research-filter-subcategory">
                                        <p class="subcategory">Besoin de plus de précision ?</p>
                                        <div class="buttons">
                                            <button class="btn btn-white btn-s  btn-r8">Indien</button>
                                            <button class="btn btn-white btn-s  btn-r8">Chinois</button>
                                            <button class="btn btn-white btn-s  btn-r8">Italien</button>
                                            <button class="btn btn-white btn-s  btn-r8">Pizza</button>
                                            <button class="btn btn-white btn-s  btn-r8">Kebab</button>
                                        </div>
                                    </div>
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

        <div class="map-and-list">
            <div id="map">

            </div>
            <template>
                <div class="stores-list">

                    <a href="">
                        <div class="element-list">
                            <div class="img-element-list">
                                <img src="{{asset('img/photos/exemple-image-store.png')}}">
                            </div>
                            <div class="info-element-list">
                                <p>Sushi Place</p>
                                <div>
                                    <span class="description-veryshort">petit texte</span>
                                    <div class="note">
                                        <span>5</span>
                                        <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;stars</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="element-list active">
                            <div class="img-element-list">
                                <img src="{{asset('img/photos/exemple-image-store.png')}}">
                            </div>
                            <div class="info-element-list">
                                <p>Sushi Place</p>
                                <div>
                                    <span class="description-veryshort">petit texte</span>
                                    <div class="note">
                                        <span>5</span>
                                        <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;stars</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="element-list">
                            <div class="img-element-list">
                                <img src="{{asset('img/photos/exemple-image-store.png')}}">
                            </div>
                            <div class="info-element-list">
                                <p>Sushi Place</p>
                                <div>
                                    <span class="description-veryshort">petit texte</span>
                                    <div class="note">
                                        <span>5</span>
                                        <span><img src="{{asset('img/icons/star.svg')}}"><span class="stars-word">&nbsp;stars</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>


                </div>
            </template>

        </div>
        <footer>
        </footer>

    </div>




    <script>


    </script>
</body>

</html>
