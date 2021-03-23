<nav v-show="!showStore">
    <a class="logo" href="{{route('home')}}">
        <img src="{{ asset('img/logo_inline-clair.svg') }}" alt="logo de click and collect">
    </a>
    <div v-on:click="mobileMenu" class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <ul class="nav-links">
        <li><a class="linkMenu" href="{{ route('home') }}"><img
                    src="{{ asset('img/icons/fa-home.svg') }}">Accueil</a></li>
        <li><a class="linkMenu" href="{{ route('homeAccount') }}"><img
                    src="{{ asset('img/icons/fa-login.svg') }}">{{$id_user ?? '' ? 'Mon compte' : 'Se connecter'}}</a></li>
        <li><a href="{{route('legalNotices')}}" class="btn-color btn-secondary btn-xs">CGU</a></li>
    </ul>
</nav>
