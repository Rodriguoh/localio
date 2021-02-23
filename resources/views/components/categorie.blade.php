<form v-on:change="refreshMapView" class="d-flex justify-content-around">
    <div class="d-flex flex-column flex-shrink-1 mx-10">
        <h5 class="m-0">Catégories</h5>
        <input class="d-none" type="radio" value="" id="tout" name="categorie" v-model="categorySelected">
        <label for="tout" class="btn px-5 mb-0 mt-5":class="categorySelected == '' && 'btn-primary'">Voir tout</label>
        <template v-for="cat in mainCat">
            <input class="d-none" :id="cat.label" type="radio" name="categorie" :value="cat.label" v-model="categorySelected" v-on:click="categoryFilter = ''">
            <label :for="cat.label" class="btn px-5 mb-0 mt-5" :class="(categorySelected == cat.label && categoryFilter == '') && 'btn-primary'">@{{ cat.label }}</label>
        </template>
    </div>
    <div class="d-flex flex-column w-full mr-10">
        <h5 class="m-0">Sous catégories</h5>
        <template v-for="cat in mainCat">
        <div class="d-flex flex-column">
            <template v-for="sub in cat?.child">
                <input class="d-none" :id="sub.id" type="radio" name="categorie" :value="sub.label" v-model="categoryFilter">
                <label class="btn px-5 mb-0 mt-5" v-show="categorySelected == cat.label" :for="sub.id" :class="categoryFilter == sub.label && 'btn-primary'">@{{ sub.label }}</label>
            </template>
        </div>
        </template>
    </div>

</form>
