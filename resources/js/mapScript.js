// import Vue from "vue/dist/vue.esm"; Import de VueJS pour la build lors de la mise en prod
// var _ = require("lodash"); Import lodash en cas de besoin
// import debounce from "lodash/debounce";
var app = new Vue({
    el: `#app`,
    data: {
        allStoreOnMap: [],
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
        }
    },
    created() {

        this.mainCat = categories;
    },
    mounted: async function () {

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