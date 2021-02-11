// import Vue from "vue/dist/vue.esm"; Import de VueJS pour la build lors de la mise en prod
// var _ = require("lodash"); Import lodash en cas de besoin

var app = new Vue({
    el: `#app`,
    data: {
        map: undefined,
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
        searchName: "",
        categorySelected: "",
    },
    methods: {
        /**
         * Function for search stores by name in autocomplete
         */
        getStoresByName: async function () {
            var requestOptions = {
                method: "GET",
                redirect: "follow",
            };

            let req = await fetch(
                `${this.baseUrl}/api/stores/${this.searchName}`, // modifier la variable search
                requestOptions
            );
            let rep = await req.json();
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

            for (let i = 0; i < rep.length; i++) {

                let lat = rep[i].latnlg.lat;
                let lon = rep[i].latnlg.lng;

                let marker = L.marker([lat, lon]);
                marker.addTo(this.map);
            }
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
    },
    mounted: function () {
        // setting up map
        this.map = L.map("map").setView(this.mapCenter, this.mapZoom);
        L.tileLayer(this.mapTiles[0], this.mapTiles[1]).addTo(this.map);

        this.getStoresOnMap();

        // add eventListener on the map movment
        this.map.on("moveend", () => {
            this.getStoresOnMap();
        });
    },
});