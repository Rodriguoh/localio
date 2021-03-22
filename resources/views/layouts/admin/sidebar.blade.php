@php
use App\Models\User;
$role = User::find(Auth::id())->role->name;
@endphp
<div class="sidebar">
    <div class="sidebar-menu">
        <!-- Sidebar brand -->
        <a href="{{ route('homeAccount') }}" class="sidebar-brand">
            Localio
        </a>
        <!-- Sidebar content with the search box -->
        <div class="sidebar-content">
            Bonjour
        </div>
        <!-- Sidebar links (with icons) and titles -->
        @if($role === 'admin')
            <h5 class="sidebar-title">Gérer les utilisateurs</h5>
            <div class="sidebar-divider"></div>
            <a href="{{ URL::route('listUsers') }}" class="sidebar-link sidebar-link-with-icon">
                <span class="sidebar-icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                Liste des utilisateurs
            </a>
            <br />
        @endif
        @if($role === 'owner')
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
        @endif

        @if($role === 'moderator')
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
        @endif

        @if($role ==='user' ||$role === 'moderator')
            <h5 class="sidebar-title">Gérer les avis</h5>
            <div class="sidebar-divider"></div>
            @if($role === 'user')
            <a href="{{ URL::route('myComments')}}" class="sidebar-link sidebar-link-with-icon">
                <span class="sidebar-icon">
                    <i class="fa fa-comment" aria-hidden="true"></i>
                </span>
                Gérer ses avis
            </a>
            @endif
            @if($role === 'moderator')
            <a href="{{ URL::route('flagComments')}}" class="sidebar-link sidebar-link-with-icon">
                <span class="sidebar-icon">
                    <i class="fa fa-comment" aria-hidden="true"></i>
                </span>
                Modérer les avis
            </a>
            @endif
        @endif
        <h5 class="sidebar-title">Gérer ses favoris</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ route('myFavorites') }}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </span>
            Gérer ses favoris
        </a>
        @if($role ==='admin')
            <h5 class="sidebar-title">Administration</h5>
            <div class="sidebar-divider"></div>
            <a href="{{ route('categories') }}" class="sidebar-link sidebar-link-with-icon">
                <span class="sidebar-icon">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </span>
                Gérer les catégories
            </a>
            <a href="{{ route('statistiques') }}" class="sidebar-link sidebar-link-with-icon">
                <span class="sidebar-icon">
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                </span>
                Statistiques
            </a>
        @endif
        <h5 class="sidebar-title">Gérer son compte</h5>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('homeAccount')}}" class="sidebar-link sidebar-link-with-icon">
            <span class="sidebar-icon">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            Paramètre du compte
        </a>
        <div class="sidebar-divider"></div>
        <a href="{{ URL::route('logout')}}" class="sidebar-link sidebar-link-with-icon text-danger">
            <span class="sidebar-icon">
                <i class="fa fa-sign-out text-danger" aria-hidden="true"></i>
            </span>
            Se deconnecter
        </a>
    </div>
</div>
