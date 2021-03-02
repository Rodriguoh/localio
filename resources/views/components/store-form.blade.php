<form name="form" id="form" action="{{route('postStore')}}" method="POST" class="mw-full" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$store->id}}">
    <div class="form-group w-400 mw-full">
        <label for="name" class="required">Nom du commerce</label>
        @if($errors->has('name'))
            <div class="invalid-feedback">
                Le nom de commerce est obligatoire.
            </div>
        @endif
        <input type="text" class="form-control" id="name" placeholder="Nom entier" name="name"
        value="{{old('name', $store->name)}}">
    </div>

    <div class="form-group w-400 mw-full">
        <label for="short_description" class="required">Description courte</label>
        @if($errors->has('short_description'))
            <div class="invalid-feedback">
                La description courte est obligatoire.
            </div>
        @endif
        <textarea class="form-control" id="short_description" name="short_description">{{old('short_description', $store->short_description)}}</textarea>
    </div>


    <div class="form-group">
        <label class="required">Une photo pour mettre en avant votre commerce</label>
        @if($errors->has('photo'))
            <div class="invalid-feedback">
                La photo est obligatoire.
            </div>
        @endif
        <div class="custom-file">
            <input type="file" id="photo" name="photo" accept="image/*">
            <label for="photo">Choisir une photo</label>
        </div>
    </div>


    <div class="form-group w-400 mw-full">
        <label for="phone" class="required">Numéro de téléphone</label>
        @if($errors->has('phone'))
            <div class="invalid-feedback">
                Le numéro de téléphone de votre commerce est obligatoire.
            </div>
        @endif
        <input type="text" class="form-control" id="phone" placeholder="Numéro" name="phone" value="{{old('phone', $store->phone)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="mail" class="required">Adresse Mail</label>
        @if($errors->has('mail'))
            <div class="invalid-feedback">
                L'adresse mail de votre commerce est obligatoire.{{$errors->first('mail')}}
            </div>
        @endif
        <input type="text" class="form-control" id="mail" placeholder="Mail" name="mail" value="{{old('mail', $store->mail)}}">
    </div>
    <div class="form-group w-400 mw-full">
        <label for="SIRET" class="required">Numéro de SIRET</label>
        @if($errors->has('SIRET'))
            <div class="invalid-feedback">
                Le numéro de SIRET est obligatoire.
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
        @if($errors->has('number') || $errors->has('street'))
            <div class="invalid-feedback">
                Le numéro et le nom de la rue sont obligatoire.
            </div>
        @endif
        <div class="form-row row-eq-spacing">
            <div class="col">
                <input type="text" class="form-control" id="number" placeholder="Numéro" name="number" required="required" value="{{old('number', $store->number)}}">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="street" placeholder="Rue" name="street" required="required" value="{{old('street', $store->street)}}">
            </div>
        </div>
    </div>

    <div class="form-group w-400 mw-full position-relative">
        <label for="city" class="required">Ville</label>
        @if($errors->has('INSEE'))
            <div class="invalid-feedback">
                Vous devez sélectionner une ville dans la liste.
            </div>
        @endif
        <input type="text" class="form-control" id="city" placeholder="Le nom de la ville" name="city" value="{{old('city', $store->city->name ?? '')}}" autocomplete="new-password">
        <ul class="position-absolute d-none auto-comp z-10 text-dark-lm text-light-dm bg-dark-light-dm bg-light-lm w-full" id="autocomplete">
        </ul>
        <p>Cliquez sur votre ville quand elle apparraitera dans la liste.</p>
        @if($errors->has('lat'))
            <div class="invalid-feedback">
                Impossible de localiser votre adresse, si cette erreur persiste, contacté un administrateur.
            </div>
        @endif
    </div>

    <input type="hidden" id="INSEE" name="INSEE" value="{{old('INSEE', $store->city_INSEE)}}">
    <input type="hidden" id="ZIPCode" name="ZIPCode" value="{{old('ZIPCode', $store->city->ZIPcode ?? '')}}">

    <input type="hidden" id="lng" name="lng" value="{{old('lng', $store->lng)}}">

    <input type="hidden" id="lat" name="lat" value="{{old('lat', $store->lat)}}">

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

    <input class="btn btn-success" id="subStore" type="button" value="Valider">

    <style>
        #city:focus + .auto-comp {
            display: block !important;
        }

        .auto-comp:hover {
            display: block !important;
        }
    </style>
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
    <script>
        const listCity = document.getElementById('autocomplete');
        document.getElementById('city').addEventListener('keyup', async (event) => {
            let req = await fetch(`https://geo.api.gouv.fr/communes?nom=${event.srcElement.value}&limit=8`)
            let rep = await req.json();
            listCity.innerHTML = '';
            rep.map((city) => {
                let li = document.createElement('li');
                li.classList.add('nav-link')
                li.append(city.nom);
                listCity.appendChild(li);
                li.addEventListener('click', () => {
                    document.getElementById('city').value = city.nom;
                    document.getElementById('INSEE').value = city.code;
                    document.getElementById('ZIPCode').value = city.codesPostaux;
                })
            });
        });

        document.getElementById('subStore').addEventListener('click', async () => {
            let [number, street, city] = [...document.querySelectorAll(['#number', '#street', '#city'])];
            let req = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${number.value + ' ' + street.value + ' ' + city.value}&type=housenumber`);
            let rep = await req.json();
            let [lng, lat] = rep?.features?.[0]?.geometry?.coordinates;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            document.form.submit();
        });
    </script>
</form>
