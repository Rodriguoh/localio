<div class="content">
    <h2 class="content-title">
        Description du commerce :
    </h2>
    <p>
        {{$store->description}}
    </p>
</div>
<div class="content">
    <h2 class="content-title">
        Informations :
    </h2>
    <p>Téléphone: {{$store->phone}}</p>
    <p>Adresse email: {{$store->mail}}</p>
    <p>Site internet: <a href="{{$store->url}}">{{$store->url}}</a></p>
    <p>Code commentaire: {{$store->codeComment}}</p>
    <p>Adresse postale: <a href="https://www.google.com/maps/search/?api=1&query={{$store->lat}},{{$store->lng}}" target="_blank">{{$store->number.' '.$store->street.' '.$store->city_insee.', '.$store->city_name}}</a></p>
    <p>Numero siret: {{$store->siret}}</p>
    <p>Livraison: {{$store->delivery == 0 ? 'Non' : 'Oui'}}</p>
    <p>Condtions de livraison: {{$store->conditionDelivery}}</p>
    <div>Horaires d'ouverture:{{$store->openingHours}}</div>
    <p>Catégorie: {{$store->category_name}}</p>
</div>
