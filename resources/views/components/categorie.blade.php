<form v-on:change="refreshMapView">
    <div v-for="cat in mainCat">
        <input :id="cat.label" type="radio" name="categorie" :value="cat.label" v-model="categorySelected">
        <label :for="cat.label">@{{ cat.label }}</label>
        <div v-show="categorySelected == cat.label" v-for="sub in subCat[cat.label]" style="display: inline-block; margin: 0 5px 0 5px;">
            <input :id="sub" type="radio" name="sub_categorie" :value="sub" v-model="categoryFilter">
            <label :for="sub">@{{ sub }}</label>
        </div>
    </div>
</form>
