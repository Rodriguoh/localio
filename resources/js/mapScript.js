// import Vue from "vue/dist/vue.esm"; Import de VueJS pour la build lors de la mise en prod
// var _ = require("lodash"); Import lodash en cas de besoin
// import debounce from "lodash/debounce";
var app = new Vue({
    el: `#app`,
    data: {
       filters_isOpen: false,
       mobileMenu_isOpen: false
    },
    methods: {
       mobileMenu: function(){
        let hamburger = document.querySelector(".hamburger");
        let navLinks = document.querySelector(".nav-links");
        let links = document.querySelectorAll(".nav-links li");
        if (!this.mobileMenu_isOpen) {
            navLinks.classList.toggle('open');
            hamburger.classList.toggle('open');
            this.mobileMenu_isOpen = !this.mobileMenu_isOpen;
        } else {
            navLinks.classList.toggle('open');
            setTimeout(function() {
                hamburger.classList.toggle('open')
            }, 700);
            this.mobileMenu_isOpen = !this.mobileMenu_isOpen;
        }

        links.forEach(link => {
            link.classList.toggle("fade");
        });
       }
    },
    mounted: async function () {
     
    },

    computed: {
    
    }
});