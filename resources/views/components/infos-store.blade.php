<div class="content">
    <h2 class="content-title">
        Description du commerce :
    </h2>
    <p>
        {!! $store->description !!}
    </p>
</div>
<div class="content">
    <h2 class="content-title">
        Informations :
    </h2>
    <p>Téléphone: {{$store->phone}}</p>
    <p>Adresse email: {{$store->mail}}</p>
    <p>Site internet: <a href="{{$store->url}}">{{$store->url}}</a></p>
    <p>Adresse postale: <a href="https://www.google.com/maps/search/?api=1&query={{$store->lat}},{{$store->lng}}" target="_blank">{{$store->number.' '.$store->street.' '.$store->city_INSEE.', '.$store->city->name}}</a></p>
    <p>Numero siret: {{$store->SIRET}}</p>
    <p>Livraison: {{$store->delivery == 0 ? 'Non' : 'Oui'}}</p>
    <p>Conditions de livraison: {{$store->conditionDelivery}}</p>
    <p>Catégorie: {{$store->category->label}}</p>
</div>
