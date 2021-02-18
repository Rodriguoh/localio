// import Vue from "vue/dist/vue.esm"; Import de VueJS pour la build lors de la mise en prod
// var _ = require("lodash"); Import lodash en cas de besoin
import debounce from "lodash/debounce";
var app = new Vue({
    el: `#app`,
    data: {
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
        baseUrl: "https://localio-app.herokuapp.com", // http://localhost/localio/public mettre l'url sur laquelle on travail
        categorySelected: "",
        querySearch: "",
        resultsQueryCity: [],
        resultsQueryStore: [],
        limitAutoCompletion: 5,
        storeSelected: {},
    },
    methods: {
        /**
         * Function for search stores by name in autocomplete
         */
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
            let requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            let url = new URL(`${this.baseUrl}/api/stores/map`);
            url.search = new URLSearchParams({
                ...(typeof categorySelected == "string" && { category: "" }),
                lat_ne: this.map.getBounds()._northEast.lat,
                lng_ne: this.map.getBounds()._northEast.lng,
                lat_sw: this.map.getBounds()._southWest.lat,
                lng_sw: this.map.getBounds()._southWest.lng,
            });

            let req = await fetch(url, requestOptions);
            let rep = await req.json();
            rep = rep.data;
            let allMarkers = [];

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

                console.log(marker)
                 marker.on("click", async () => {

                   await this.getStore(rep[i].id); 
                   await halfmoon.toggleModal("modal-store");
                
                });

                allMarkers.push(marker);
            }

            this.markers = L.layerGroup(allMarkers);
        },
        /**
         * Function to get all details on a store
         */
        getStore: async function (storeId) {
            let requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            let url = new URL(`${this.baseUrl}/api/store/${storeId}`);
            let req = await fetch(url, requestOptions);
            let rep = await req.json();

            this.storeSelected =  rep.data;

            console.log(this.storeSelected)
            console.log(typeof (this.storeSelected.openingHours))
            
        },
        /**
         * Function to get comments with paginate on a store
         */
        getStoreComments: async function (storeId, nbPage = null) {
            let requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            let url = new URL(`${this.baseUrl}/api/store/${storeId}/comments`);
            url.search = new URLSearchParams({
                ...(nbPage != null && { page: nbPage }),
            });

            let req = await fetch(url, requestOptions);
            let rep = await req.json();
        },
        autoComplete: async function () {
            this.resultsQueryCity = [];
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

            this.resultsQueryStore = [];

            let reqStores = await fetch(
                `${this.baseUrl}/api/stores/${this.querySearch}`, // modifier la variable search
                requestOptions
            );
            let dataStores = await reqStores.json();

            this.resultsQueryStore = dataStores.data;
        },
        setViewMap: function (lat, lon) {
            this.map.setView([lat, lon], 14);
        },
        consolelog(message) {
            console.log(message);
        },
    },
    mounted: async function () {
        // setting up map
        this.map = L.map("map").setView(this.mapCenter, this.mapZoom);
        L.tileLayer(this.mapTiles[0], this.mapTiles[1]).addTo(this.map);

        await this.getStoresOnMap();
        await this.map.addLayer(this.markers);

        // add eventListener on the map movment
        this.map.on("moveend", async () => {
            this.map.removeLayer(this.markers);
            await this.getStoresOnMap();
            await this.map.addLayer(this.markers);
        });
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
    },
});
