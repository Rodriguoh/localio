<div class="sidebar">
    <div class="sidebar-menu">
        <!-- Sidebar brand -->
        <a href="#" class="sidebar-brand">
            Administration
        </a>
        <!-- Sidebar content with the search box -->
        <div class="sidebar-content">
            Bonjour
        </div>
        <!-- Sidebar links (with icons) and titles -->
        <h5 class="sidebar-title">Gérer les utilisateurs</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('listUsers') }}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            Liste des utilisateurs
        </a>
        <br />
        <h5 class="sidebar-title">Gérer ses commerces</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('myStores') }}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </span>
            Mes commerces
        </a>
        <a href="{{ URL::route('createStore') }}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </span>
            Ajouter un commerce
        </a>

        <h5 class="sidebar-title">Modérer les commerces</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('listStores')}}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </span>
            Liste des commerces
        </a>
        <a href="{{ URL::route('requestsStores')}}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </span>
            Traiter les demandes
        </a>
        <!--
        <a href="#" class="sidebar-link sidebar-link-with-icon" disabled>
            <span class="sidebar-icon">
                <i class="fa fa-exclamation" aria-hidden="true"></i>
            </span>
            Gerer les signalements
        </a>
        -->
        </br>
        <h5 class="sidebar-title">Gérer ses avis</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('myComments')}}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-comment" aria-hidden="true"></i>
            </span>
            Gérer ses avis
        </a>
        </br>
        <h5 class="sidebar-title">Gérer ses favoris</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ route('myFavorites') }}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </span>
            Gérer ses favoris
        </a>
        </br>
        <h5 class="sidebar-title">Gérer son compte</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('settingsAccount')}}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            Parametre du compte
        </a>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('logout')}}" class="sidebar-link sidebar-link-with-icon" style="color:red">
            Se deconnecter
        </a>
    </div>
</div>
