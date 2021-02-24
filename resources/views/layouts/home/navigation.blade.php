<nav class="navbar">
        <a href="{{route('home')}}" class="navbar-brand">
            <img src="{{asset('img/logo_inline-clair.svg')}}" alt="logo-localio">
        </a>
        <ul class="navbar-nav ml-auto"> <!-- ml-auto = margin-left: auto -->

        <li class="nav-item dropdown with-arrow">
            <a class="nav-link" data-toggle="dropdown" id="nav-link-dropdown-toggle">
              Navigation
              <i class="fa fa-angle-down ml-5" aria-hidden="true"></i> <!-- ml-5= margin-left: 0.5rem (5px) -->
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="nav-link-dropdown-toggle">
              <a href="{{route('home')}}" class="dropdown-item">Accueil</a>
              @if(Auth::check())
              <a href="{{route('homeAccount')}}" class="dropdown-item">Mon compte</a>
              @else
              <a href="{{route('login')}}" class="dropdown-item">
                Connection
                <strong class="badge badge-success float-right">New</strong> <!-- float-right = float: right -->
              </a>
              @endif
              <div class="dropdown-divider"></div>
              <div class="dropdown-content text-center">
                <button class="btn btn-action mr-5" type="button" onclick="halfmoon.toggleDarkMode()" aria-label="Toggle dark mode">
                    <i class="fa fa-moon-o" aria-hidden="true"></i>
                </button>
              </div>
              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item">Conditions d'utilisation</a>
              <a href="{{route('legalNotices')}}" class="dropdown-item">Mentions légales</a>
            </div>
          </li>
        </ul>
        {{-- <ul class="main-menu">
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
        </ul> --}}
    </nav>
