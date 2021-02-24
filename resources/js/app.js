require("./bootstrap");
require("alpinejs");

// Librairie

function _id(x) {
    return document.getElementById(x);
}
function _class(x) {
    return document.getElementsByClassName(x);
}
function _tag(x) {
    return document.getElementsByTagName(x);
}
function cl(x) {
    return console.log(x);
}

//Accueil
function scrollChange() {
    let scroll = this;
    let arrow = scroll.firstChild;
    let url = this.href.substring(this.href.lastIndexOf("/") + 1);

    if (url == "#top") {
        arrow.style.transform = "rotate(90deg)";
    } else {
        arrow.style.transform = "rotate(-90deg)";
    }

    setTimeout(function () {
        if (url == "#top") {
            scroll.href = "#bottom";
            arrow.style.transform = "rotate(90deg)";
        } else {
            scroll.href = "#top";
            arrow.style.transform = "rotate(-90deg)";
        }
    }, 50);
}

_id("scroll")?.addEventListener("click", scrollChange);
