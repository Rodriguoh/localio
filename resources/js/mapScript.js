// import Vue from "vue/dist/vue.esm"; Import de VueJS pour la build lors de la mise en prod
// var _ = require("lodash"); Import lodash en cas de besoin
// import debounce from "lodash/debounce";
var app = new Vue({
    el: `#app`,
    data: {
        /* MAP */
        map: undefined,
        markers: undefined,
        mapTiles: [
            "https://{s}.tile.osm.org/{z}/{x}/{y}.png",
            {
                attribution: "",
                minNativeZoom: 4,
                minZoom: 4,
            },
        ],
        mapCenter: [44.5667, 6.0833],
        mapZoom: 13,
        allStoreOnMap: [],
        /* SEARCH */
        filters_isOpen: false,
        mobileMenu_isOpen: false,
        querySearch: "",
        resultsQueryCity: [],
        resultsQueryStore: [],
        baseUrl: "https://localio-app.herokuapp.com",
        limitAutoCompletion: 3,
        mainCat: [],
        subCat: {},
        categorySelected: "",
        prevCatSelected: "",
        categoryFilter: ""

    },
    methods: {
        mobileMenu: function () {
            let hamburger = document.querySelector(".hamburger");
            let navLinks = document.querySelector(".nav-links");
            let links = document.querySelectorAll(".nav-links li");
            if (!this.mobileMenu_isOpen) {
                navLinks.classList.toggle('open');
                hamburger.classList.toggle('open');
                this.mobileMenu_isOpen = !this.mobileMenu_isOpen;
            } else {
                navLinks.classList.toggle('open');
                setTimeout(function () {
                    hamburger.classList.toggle('open')
                }, 700);
                this.mobileMenu_isOpen = !this.mobileMenu_isOpen;
            }

            links.forEach(link => {
                link.classList.toggle("fade");
            });
        },
        autoComplete: async function () {
            this.resultsQueryCity = [];
            this.resultsQueryStore = [];
            if (this.querySearch.length < 1) return;

            //Récupération des noms de villes en fonction de l'entrée utilisateur
            let requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            let url = new URL(`https://geo.api.gouv.fr/communes`);
            url.search = new URLSearchParams({
                ...{
                    nom: this.querySearch,
                    format: "geojson",
                    fields: "code,departement",
                    boost: "population",
                    limit: this.limitAutoCompletion,
                },
            });
            let reqCities = await fetch(url, requestOptions);
            let data = await reqCities.json();
            this.resultsQueryCity = data.features;

            let urlStore = new URL(
                `${this.baseUrl}/api/stores/${this.querySearch}`
            );
            urlStore.search = new URLSearchParams({
                ...(this.categorySelected.length > 0
                    ? this.categoryFilter.length > 0
                        ? {
                            category: this.categoryFilter,
                        }
                        : {
                            category: this.categorySelected,
                        }
                    : {}),
            });
            let reqStores = await fetch(
                urlStore, // modifier la variable search
                requestOptions
            );
            let dataStores = await reqStores.json();

            this.resultsQueryStore = dataStores.data;
        },
        getStoresByName: async function () {
            let requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            let reqStores = await fetch(
                `${this.baseUrl}/api/stores/${this.querySearch}`, // modifier la variable search
                requestOptions
            );
            let data = await reqStores.json();
            console.log(data);
            return data.data;
        },
        /**
         * Function to get all store to display on map
         */
        getStoresOnMap: async function () {
            if (this.prevCatSelected != this.categorySelected) {
                this.categoryFilter = "";
            }
            let catFilter;
            let requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            this.categoryFilter === ""
                ? (catFilter = this.categorySelected)
                : (catFilter = this.categoryFilter);
            if (document.getElementById("tout").checked == true) {
                catFilter = "";
            }
            let url = new URL(`${this.baseUrl}/api/stores/map`);
            url.search = new URLSearchParams({
                ...(catFilter.length > 0 && {
                    category: catFilter,
                }),
                lat_ne: this.map.getBounds()._northEast.lat,
                lng_ne: this.map.getBounds()._northEast.lng,
                lat_sw: this.map.getBounds()._southWest.lat,
                lng_sw: this.map.getBounds()._southWest.lng,
            });

            let req = await fetch(url, requestOptions);
            let rep = await req.json();
            rep = rep.data;
            let allMarkers = new L.MarkerClusterGroup();

            for (let i = 0; i < rep.length; i++) {
                let icone_img = "";
                switch (rep[i].category_id) {
                    case 1:
                        icone_img = "img/markers/restauration.png";
                        break;
                    case 71:
                        icone_img = "img/markers/alimentaire.png";
                        break;
                    case 141:
                        icone_img = "img/markers/bio.png";
                        break;
                    case 191:
                        icone_img = "img/markers/sante.png";
                        break;
                    case 251:
                        icone_img = "img/markers/culture.png";
                        break;
                    case 311:
                        icone_img = "img/markers/habillement.png";
                        break;
                    default:
                        icone_img = "img/markers/default.png";
                        break;
                }
                let icone = L.icon({
                    iconUrl: icone_img,
                    shadowUrl: "img/markers/shadow.png",
                    iconSize: [30, 42.5],
                    shadowSize: [40, 40],
                    shadowAnchor: [15, 19],
                });

                let lat = rep[i].latnlg.lat;
                let lon = rep[i].latnlg.lng;
                let marker = L.marker([lat, lon], { icon: icone });

                // Affiche la modal lors du clic sur le marqueur
                marker.on("click", async () => {
                    await this.getStore(rep[i].id);
                    await this.getStoreComments(rep[i].id);
                    await halfmoon.toggleModal("modal-store");
                    this.commentLimit = 1;
                });

                // Change la couleur de fond de la div du commerce lors du hover de son marqueur
                marker.on("mouseover", async () => {
                    let store = document.getElementById(
                        "list-store-" + rep[i].id
                    );
                    store.classList.add("bg-dark");
                    store.style.opacity = "70%";
                    store.style.color = "white";
                    store.scrollIntoView();
                });

                // remet la couleur de fond de la div lors que la souris sort la zone du marqueur
                marker.on("mouseout", async () => {
                    let store = document.getElementById(
                        "list-store-" + rep[i].id
                    );
                    store.classList.remove("bg-dark");
                    store.style.color = "black";
                    store.style.opacity = "100%";
                });

                allMarkers.addLayer(marker);
            }

            this.prevCatSelected = this.categorySelected;
            this.markers = allMarkers;
            this.allStoreOnMap = rep;

        },
        setViewMap: function (lat, lon) {
            document.querySelector("#map").scrollIntoView();
            this.querySearch = '';
            this.map.setView([lat, lon], 14);
        },
    },
    created() {

        this.mainCat = categories;
    },
    mounted: async function () {
        //setting up map
        this.map = L.map('map', { scrollWheelZoom: false, zoomControl: false }).setView(this.mapCenter, this.mapZoom);
        L.control.zoom({
            position: 'topright'
        }).addTo(this.map);

        // L.tileLayer(this.mapTiles[0], this.mapTiles[1]).addTo(this.map);
        L.tileLayer.provider('Jawg.Sunny', {
            variant: '',
            accessToken: '9zKBU8aYvWv4EZGNqDxbchlyWN5MUsWUAHGn3ku9anzWz8nndmhQprvQGH1aikE5'
        }).addTo(this.map);

        //await this.getStoresOnMap();
        //await this.map.addLayer(this.markers);


    },

    computed: {
        computedResultsQueryCity() {
            return this.limitAutoCompletion
                ? this.resultsQueryCity.slice(0, this.limitAutoCompletion)
                : this.resultsQueryCity;
        },
        computedResultsQueryStore() {
            return this.limitAutoCompletion
                ? this.resultsQueryStore.slice(0, this.limitAutoCompletion)
                : this.resultsQueryStore;
        },
    }
});