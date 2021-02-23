<form action="{{route('postStore')}}" method="POST" class="mw-full">
    @csrf
    <input type="hidden" name="id" value="{{$store->id}}">
    <div class="form-group w-400 mw-full">
        <label for="name" class="required">Nom du commerce</label>
        @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
                @endif
        <input type="text" class="form-control" id="name" placeholder="Nom entier" name="name"
        value="{{old('name', $store->name)}}">
    </div>

    <div class="form-group w-400 mw-full">
        <label for="short_description" class="required">Description courte</label>
        @if($errors->has('short_description'))
                <div class="invalid-feedback">
                    {{$errors->first('short_description')}}
                </div>
                @endif
        <textarea class="form-control" id="short_description" name="short_description">{{old('short_description', $store->short_description)}}</textarea>
    </div>

    <div class="form-group w-400 mw-full">
        <label for="phone" class="required">Numéro de téléphone</label>
        @if($errors->has('phone'))
                <div class="invalid-feedback">
                    {{$errors->first('phone')}}
                </div>
                @endif
        <input type="text" class="form-control" id="phone" placeholder="Numéro" name="phone" value="{{old('phone', $store->phone)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="mail" class="required">Adresse Mail</label>
        @if($errors->has('mail'))
                <div class="invalid-feedback">
                    {{$errors->first('mail')}}
                </div>
                @endif
        <input type="text" class="form-control" id="mail" placeholder="Mail" name="mail" value="{{old('mail', $store->mail)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="SIRET" class="required">Numéro de SIRET</label>
        @if($errors->has('SIRET'))
                <div class="invalid-feedback">
                    {{$errors->first('SIRET')}}
                </div>
                @endif
        <input type="text" class="form-control" id="SIRET" placeholder="SIRET" name="SIRET" value="{{old('SIRET', $store->SIRET)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="url">URL de votre site internet</label>
        <input type="text" class="form-control" id="url" placeholder="L'url" name="url" value="{{old('url', $store->url)}}">
    </div>

    <div class="form-group w-400 mw-full">
        <label for="category" class="required">Categorie</label>
        <select class="form-control" id="category" required name="category_id">
            <option value="" selected="selected" disabled="disabled">Choisir une catégorie</option>
            @foreach($categories as $category)
                <option {{old('category_id', $store->category_id) == $category->id ? "selected": ""}} value="{{$category->id}}">{{$category->label}}</option>
                @foreach($category->child as $categoryChild)
                    <option {{old('category_id', $store->category_id) == $categoryChild->id ? "selected": ""}} value="{{$categoryChild->id}}"> -  {{$categoryChild->label}}</option>
                @endforeach
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <textarea name="description" id="editor">{{old('description', $store->description)}}</textarea>
    </div>


    <h3 class="card-title">
        Localisation
    </h3>

    <div class="w-400 mw-full">
        <label for="number" class="required">Adresse</label>
        <div class="form-row row-eq-spacing">
            <div class="col">
                <input type="text" class="form-control" id="number" placeholder="Numéro" name="number" required="required" value="{{old('number', $store->number)}}">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="street" placeholder="Rue" name="street" required="required" value="{{old('street', $store->street)}}">
            </div>
        </div>
    </div>

    <h4>Provisoire</h4>
    <div class="form-group w-400 mw-full">
        <label for="city">Ville</label>
        <input type="text" class="form-control" id="city" placeholder="Le nom de la ville" name="city" value="{{old('city', $store->city->name ?? '')}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="INSEE">INSEE</label>
        <input type="text" class="form-control" id="INSEE" placeholder="Numéro INSEE" name="INSEE" value="{{old('INSEE', $store->city_INSEE)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="ZIPCode">Code Postal</label>
        <input type="text" class="form-control" id="ZIPCode" placeholder="Code postal" name="ZIPCode" value="{{old('ZIPCode', $store->city->ZIPcode ?? '')}}">
    </div>

    <H3>Localisation Provisoire</H3>
    <div class="form-group w-400 mw-full">
        <label for="lng">Longitude</label>
        <input type="text" class="form-control" id="lng" name="lng" value="{{old('lng', $store->lng)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" id="lat" name="lat" value="{{old('lat', $store->lat)}}">
    </div>

    <h3 class="card-title">
        Livraison
    </h3>

    <div class="form-group w-400 mw-full">
        <div class="custom-switch">
            <input type="checkbox" id="delivery" value="true" {{old('delivery', $store->delivery) ? "checked" : ""}} name="delivery">
            <label for="delivery">Propose la livraison</label>
        </div>
    </div>

    <div class="form-group w-400 mw-full">
        <label for="conditionDelivery">Condition de livraison</label>
        <textarea class="form-control" id="conditionDelivery" name="conditionDelivery" placeholder="Condition de livraison">{{old('conditionDelivery', $store->conditionDelivery)}}</textarea>
    </div>

    <input class="btn btn-success" type="submit" value="Valider">

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        var editor = CKEDITOR.replace( 'editor', {
            filebrowserUploadUrl: "{{route('ckeditor.upload',['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            uiColor: '#ADD8E6',
            width:'100%',
            height:500
        } );
    </script>
</form>
