    <!-- Navbar start -->
        <nav class="navbar d-flex justify-content-between align-items-center">
            <button class="btn btn-action" type="button" onclick="halfmoon.toggleSidebar()">
                <i class="fa fa-bars" aria-hidden="true"></i>
                <span class="sr-only">Toggle sidebar</span> <!-- sr-only = show only on screen readers -->
            </button>
            <a href="{{URL::route('home')}}">
            <img src="{{asset('img/logos/logo-sombre.png')}}" alt="logo-localio" style="height:35px">
            </a>
             
            <button class="btn btn-action mr-5" type="button" onclick="halfmoon.toggleDarkMode()" aria-label="Toggle dark mode">
                <i class="fa fa-moon-o" aria-hidden="true"></i>
            </button>
        </nav>
        <!-- Navbar end -->