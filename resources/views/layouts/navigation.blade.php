
<header>
    <nav class="navbar" id="top">
        <a href="{{route('home')}}" class="site-logo">
            <img src="{{asset('img/logo_inline-clair.svg')}}" alt="logo-localio">
        </a>
        <ul class="main-menu">
            <a href="{{route('home')}}" class="menu-link">
                <li>Accueil</li>
            </a>
            @if(Auth::check())
            <a href="{{route('homeAccount')}}" class="menu-link">
                <li>Mon compte</li>
            </a>
            @else
            <a href="{{route('login')}}" class="menu-link">
                <li>Connexion</li>
            </a>
            @endif
        </ul>
        <input type="checkbox" class="burger-menu">
        <div class="burger-menu">
            <hr>
            <hr>
            <hr>
        </div>
        <div class="background-menu"></div>
        <ul class="mobile-menu">
            <a href="{{route('home')}}">
                <li>Accueil</li>
            </a>
            @if(Auth::check())
            <a href="{{route('homeAccount')}}">
                <li>Mon compte</li>
            </a>
            @else
            <a href="{{route('login')}}">
                <li>Connexion</li>
            </a>
            @endif
            <!--
            <a href="#">
                <li>S'inscrire</li>
            </a>
            -->
        </ul>
    </nav>
</header>

