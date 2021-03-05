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

    </style>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body class="full-with">

    <nav>
        <div class="logo">
            <img src="{{asset('img/logo_inline-clair.svg')}}" alt="logo de click and collect">
        </div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>          
        </div>
        <ul class="nav-links close">
            <li><a href="#0">Accueil</a></li>
            <li><a href="#0">Se connecter</a></li>
            <li><a href="#0" class="btn-color btn-secondary btn-xs">Aide</a></li>
        </ul>
    </nav>

    <div class="margin-constraint">
        <div class="useful-width">
            <div>
                <div class="illustration_home">
                    <img src="{{asset('img/illustrations/home_car.svg')}}">
                </div>

            </div>
            <div>
                <h1>Avec Localio le click and drive n’a jamais été aussi simple.</h1>
                <p>Recherchez des magasins de proximité proposant le Click and Collect facilement avec Localio. Consultez et commandez vos produits en ligne pour ensuite retirer les articles à l’heure que vous souhaitez.</p>

                <div class="research">
                    <input type="text" value="Exemplio">
                    <div class="research-filter">
                        <div class="filter">
                            <div class="research-filter-category">
                                <p>Catégorie</p>
                                <button class="button-fullwith button-color">Voir tout</button>
                                <button class="button-color">Restaurant</button>
                                <button class="button-white">Alimentaire</button>
                                <button class="button-white">Culture</button>
                                <button class="button-white">Habits</button>
                            </div>
                            <div class="research-filter-subcategory">
                                <p>Sous catégories</p>
                                <button class="button-color">Indien</button>
                                <button class="button-white">Chinois</button>
                                <button class="button-white">Italien</button>
                                <button class="button-white">Pizza</button>
                                <button class="button-white">Kebab</button>
                            </div>
                            <div>
                            </div>
                        </div>
                        <button class="button-action">Appliquer</button>
                    </div>
                </div>
                <div class="map-list">
                    <div id="map">

                    </div>
                    <div class="stores-list">
                        <div class="element-list element-list-active">
                            <div class="img-element-list">
                                <img src="{{asset('img/photos/exemple-image-store.png')}}">
                            </div>
                            <div class="info-element-list">
                                <p>Sushi Place</p>
                                <div>
                                    <span>petit texte</span>
                                    <div class="note">
                                        <span>5</span>
                                        <span><img src="{{asset('img/icons/star.svg')}}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-list">
                            <div class="img-element-list">
                                <img src="{{asset('img/photos/exemple-image-store.png')}}">
                            </div>
                            <div class="info-element-list">
                                <p>Sushi Place</p>
                                <div>
                                    <span>petit texte</span>
                                    <div class="note">
                                        <span>5</span>
                                        <span><img src="{{asset('img/icons/star.svg')}}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
    </footer>




    <script>
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");
        const links = document.querySelectorAll(".nav-links li");
        let menuClose = true;
        hamburger.addEventListener("click", () => {
            if (menuClose) {
                navLinks.classList.replace("close", "open");
                hamburger.classList.toggle('open');
                menuClose = !menuClose;
            } else {
                navLinks.classList.replace("open", "close");
                setTimeout(function(){ hamburger.classList.toggle('open') }, 700);
                menuClose = !menuClose;
            } 

            links.forEach(link => {
                link.classList.toggle("fade");
            });
        });

    </script>
</body>

</html>
