<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script src="{{ asset('js/leaflet-providers.js') }}"></script>

<p><span class="badge badge-secondary"><label for="" class="required"></label> = Champ obligatoire</span></p>
<form name="form" id="form" action="{{route('postStore')}}" method="POST" class="mw-full" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 px-md-10">
            <input type="hidden" name="id" value="{{$store->id}}">
        <div class="form-group w-400 mw-full">
        <label for="name" class="required">Nom du commerce</label>
        @if($errors->has('name'))
        <div class="invalid-feedback">
            Le nom de commerce est obligatoire.
        </div>
        @endif
        <input type="text" class="form-control" id="name" placeholder="L'incroyable Pizzeria" name="name" value="{{old('name', $store->name)}}">
    </div>

    <div class="form-group w-400 mw-full">
        <label for="short_description" class="required">Description courte (max: 255 caractères)</label>
        @if($errors->has('short_description'))
        <div class="invalid-feedback">
            La description courte est obligatoire.
        </div>
        @endif
        <textarea class="form-control" id="short_description" placeholder="Pizzas faites avec amour et cuite au feu de bois !" name="short_description">{{old('short_description', $store->short_description)}}</textarea>
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
        @if(isset($store->photos()->first()->url))
            <div>
                <p>Photo actuellement visible</p>
                <img style="max-width: 200px" src="{{$store->photos()->first()->url}}" alt="">
            </div>
        @endif
    </div>
        </div>
        <div class="col-md-6 px-md-10">
            <div class="form-group w-400 mw-full">
                <label for="category" class="required">Catégorie</label>
                <select class="form-control" id="category" required name="category_id">
                    <option value="" selected="selected" disabled="disabled">Choisir une catégorie</option>
                    @foreach($categories as $category)
                    <option {{old('category_id', $store->category_id) == $category->id ? "selected": ""}} value="{{$category->id}}">{{$category->label}}</option>
                    @foreach($category->child as $categoryChild)
                    <option {{old('category_id', $store->category_id) == $categoryChild->id ? "selected": ""}} value="{{$categoryChild->id}}"> - {{$categoryChild->label}}</option>
                    @endforeach
                    @endforeach
                </select>
            </div>

            <div class="form-group w-400 mw-full">
                <label for="phone" class="required">Numéro de téléphone (sans espaces)</label>
                @if($errors->has('phone'))
                <div class="invalid-feedback">
                    Le numéro de téléphone de votre commerce est obligatoire.
                </div>
                @endif
                <input type="text" class="form-control" id="phone" placeholder="0612482598" name="phone" value="{{old('phone', $store->phone)}}">
            </div>
            <div class="form-group w-400 mw-full">
                <label for="mail" class="required">Adresse Mail</label>
                @if($errors->has('mail'))
                <div class="invalid-feedback">
                    L'adresse mail de votre commerce est obligatoire.{{$errors->first('mail')}}
                </div>
                @endif
                <input type="text" class="form-control" id="mail" placeholder="contact@pizza.com" name="mail" value="{{old('mail', $store->mail)}}">
            </div>
            <div class="form-group w-400 mw-full">
                <label for="SIRET" class="required">Numéro de SIRET (sans espaces)</label>
                @if($errors->has('SIRET'))
                <div class="invalid-feedback">
                    Le numéro de SIRET est obligatoire.
                </div>
                @endif
                <input type="text" class="form-control" id="SIRET" placeholder="36252187900034" name="SIRET" value="{{old('SIRET', $store->SIRET)}}">
            </div>
            <div class="form-group w-400 mw-full">
                <label for="url">URL de votre site internet</label>
                <input type="text" class="form-control" id="url" placeholder="incroyable-pizza.fr" name="url" value="{{old('url', $store->url)}}">
            </div>

        </div>
    </div>







    <p>Dans cet éditeur de texte, vous pouvez décrire en détail votre commerce, insérer des photos ou encore préciser vos horaires d'ouvertures.</p>

    <div class="form-group">
        <textarea name="description" id="editor">{{old('description', isset($store->description) ? $store->description :

            '<h3>Horaires : </h3>
        <table border="1" width="60%">
            <thead>
                <tr>
                    <th>Jour</th>
                    <td align="center">Horaires</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Lundi</th>
                    <td align="center"></td>
                </tr>

                <tr>
                    <th>Mardi</th>
                    <td align="center"></td>
                </tr>

                <tr>
                    <th>Mercredi</th>
                    <td align="center"></td>
                </tr>

                <tr>
                    <th>Jeudi</th>
                    <td align="center"></td>
                </tr>

                <tr>
                    <th>Vendredi</th>
                    <td align="center"></td>
                </tr>

                <tr>
                    <th>Samedi</th>
                    <td align="center"></td>
                </tr>

                <tr>
                    <th>Dimanche</th>
                    <td align="center"></td>
                </tr>
            </tbody>
        </table>'

        )}}

        </textarea>
    </div>


    <div class="row">
        <div class="col-md-6 p-md-10">
            <p>En précisant l'adresse exacte, nous pourrons localiser votre commerce afin que les utilisateurs puissent s'y rendre facilement.</p>


            <div class="form-group w-400 mw-full position-relative">
                <label for="city" class="required">Adresse</label>
                @if($errors->has('INSEE'))
                <div class="invalid-feedback">
                    Vous devez sélectionner une adresse dans la liste.
                </div>
                @endif
                <input type="text" class="form-control" id="adress" placeholder="25 Rue de France Paris" name="adress" value="{{old('adress', isset($store->number) ? $store->number . ' ' . $store->street . ' ' . $store->city->name : '')}}" autocomplete="new-password">
                <ul class="position-absolute d-none auto-comp z-10 text-dark-lm text-light-dm bg-dark-light-dm bg-light-lm w-full" id="autocomplete">
                </ul>
                <p><span class="badge badge-secondary">Important :</span> Cliquez sur votre adresse quand elle apparraitera dans la liste.</p>
                @if($errors->has('lat'))
                <div class="invalid-feedback">
                    Impossible de localiser votre adresse, si cette erreur persiste, contacté un administrateur.
                </div>
                @endif
            </div>

            <div class="w-400 mw-full">
                <label for="number">Adresse</label>
                @if($errors->has('number') || $errors->has('street'))
                <div class="invalid-feedback">
                    Le numéro et le nom de la rue sont obligatoire.
                </div>
                @endif
                <div class="form-row row-eq-spacing">
                    <div class="col">
                        <input type="text" class="form-control disabled" id="number" name="number" readonly value="{{old('number', $store->number)}}">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control disabled" id="street" name="street" readonly value="{{old('street', $store->street)}}">
                    </div>
                </div>
                <label for="city">Ville</label>
                <input type="text" class="form-control disabled" name="city" id="city" readonly value="{{old('city', $store->city->name ?? '')}}">
            </div>

            <input type="hidden" id="INSEE" name="INSEE" value="{{old('INSEE', $store->city_INSEE)}}">
            <input type="hidden" id="ZIPCode" name="ZIPCode" value="{{old('ZIPCode', $store->city->ZIPcode ?? '')}}">
            <input type="hidden" id="lng" name="lng" value="{{old('lng', $store->lng)}}">
            <input type="hidden" id="lat" name="lat" value="{{old('lat', $store->lat)}}">
        </div>
        <div class="col-md-6 p-md-10">
            <div id="map" style="height: 170px"></div>
            <div class="form-group w-400 mw-full mt-10">
                <div class="custom-switch">
                    <input type="checkbox" id="delivery" value="true" {{old('delivery', $store->delivery) ? "checked" : ""}} name="delivery">
                    <label for="delivery">Propose la livraison</label>
                </div>
            </div>

            <div class="form-group w-400 mw-full">
                <label for="conditionDelivery">Condition de livraison</label>
                <textarea class="form-control" id="conditionDelivery" name="conditionDelivery" {{old('delivery', $store->delivery) ? "" : "disabled"}} placeholder="Commande supérieur à 20€">{{old('conditionDelivery', $store->conditionDelivery)}}</textarea>
            </div>
        </div>
    </div>

    <input class="btn btn-success mt-md-10" id="subStore" type="submit" value="Enregistrer">

    <style>
        #adress:focus+.auto-comp {
            display: block !important;
        }

        .auto-comp:hover {
            display: block !important;
        }
        .leaflet-control-attribution{
            display: none;
        }
    </style>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        var editor = CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('ckeditor.upload',['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            uiColor: '#ADD8E6',
            width: '100%',
            height: 500
        });
    </script>
    <script>
        const listCity = document.getElementById('autocomplete');
        document.getElementById('adress').addEventListener('keyup', async (event) => {
            let req = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${event.srcElement.value}&type=housenumber&autocomplete=1`)
            let rep = await req.json();
            listCity.innerHTML = '';
            rep?.features.map((adress) => {
                let li = document.createElement('li');
                li.classList.add('nav-link')
                li.append(adress?.properties?.label);
                listCity.appendChild(li);
                li.addEventListener('click', () => {
                    document.getElementById('number').value = adress?.properties?.housenumber ?? '';
                    document.getElementById('street').value = adress?.properties?.street ?? '';
                    document.getElementById('city').value = adress?.properties?.city ?? '';
                    document.getElementById('INSEE').value = adress?.properties?.citycode;
                    document.getElementById('ZIPCode').value = adress?.properties?.postcode;
                    document.getElementById('lng').value = adress?.geometry?.coordinates[0];
                    document.getElementById('lat').value = adress?.geometry?.coordinates[1];
                    event.srcElement.value = adress?.properties?.label;
                    mymap?.eachLayer(((layer) => {!!layer.toGeoJSON && mymap.removeLayer(layer)}));
                    L.marker([adress?.geometry?.coordinates[1], adress?.geometry?.coordinates[0]]).addTo(mymap);
                    mymap?.setView([adress?.geometry?.coordinates[1], adress?.geometry?.coordinates[0]], 18)
                })
            });
        });

        document.getElementById('delivery').addEventListener('change', (event) => {
            if(event.srcElement.checked) {
                document.getElementById('conditionDelivery').removeAttribute('disabled');
            } else {
                document.getElementById('conditionDelivery').setAttribute('disabled', 'disabled');
            }
        });

        var lat = @json($store->lat);
        var lng = @json($store->lng);

        var mymap = L.map('map').setView([lat ?? 44.5667, lng ?? 6.0833], 18);
        L.tileLayer.provider('Jawg.Sunny', {
            minZoom: 8,
            variant: '',
            accessToken: '9zKBU8aYvWv4EZGNqDxbchlyWN5MUsWUAHGn3ku9anzWz8nndmhQprvQGH1aikE5'
        }).addTo(mymap);

        !!lat && L.marker([lat, lng]).addTo(mymap);
    </script>
</form>
