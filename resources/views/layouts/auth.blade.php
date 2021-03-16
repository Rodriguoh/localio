<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta name="viewport" content="width=device-width" />

    <!-- Favicon and title -->
    <link rel="icon" href="path/to/fav.png">
    <title>Login</title>

</head>
<body class="full-with">
    <div id="app">
        <nav>
            <div class="logo">
                <img src="{{asset('img/logo_inline-clair.svg')}}" alt="logo de click and collect">
            </div>
            <div v-on:click="mobileMenu" class="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul class="nav-links">
                <li><a class="linkMenu" href="#0"><img src="{{asset('img/icons/fa-home.svg')}}">Accueil</a></li>
                <li><a class="linkMenu" href="#0"><img src="{{asset('img/icons/fa-login.svg')}}">Se connecter</a></li>
                <li><a href="#0" class="btn-color btn-secondary btn-xs">Aide</a></li>
            </ul>
        </nav>
        <!-- Container avec les marges -->
        <div class="margin-constraint">
         <!-- Container largeur utile -->
            <div class="useful-width">
              <!-- 
                Contenu de la page
              -->
            </div>
        </div>
        <footer>
        </footer>

    </div>
</body>
</html>
