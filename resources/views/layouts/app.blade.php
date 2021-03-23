<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Localio') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Halfmoon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />
    <!-- Halfmoon JS -->
    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js" defer></script>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}


</head>

<body class="with-custom-webkit-scrollbars with-custom-css-scrollbars" data-dm-shortcut-enabled="true" data-sidebar-shortcut-enabled="true" data-set-preferred-mode-onload="true">
    <!-- Modals go here -->
    <!-- Reference: https://www.gethalfmoon.com/docs/modal -->

    <!-- Page wrapper start -->
    <div class="page-wrapper with-navbar with-sidebar" data-sidebar-type="full-height">

        <!-- Sticky alerts (toasts), empty container -->
        <!-- Reference: https://www.gethalfmoon.com/docs/sticky-alerts-toasts -->
        <div class="sticky-alerts"></div>

        @include('layouts.admin.navbar')

        <!-- Sidebar overlay -->
        <div class="sidebar-overlay"></div>

        @include('layouts.admin.sidebar')

        <!-- Content wrapper start -->
        <div class="content-wrapper p-20">
            @yield('content')
        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- Page wrapper end -->

    <script>
    // Test the device
    let isMobile = window.matchMedia("only screen and (max-width: 768px)").matches;
      if(isMobile){
        // if device < 768px
        // add attribute ("data-sidebar-hidden", "hidden") to hide the sidebar
        let pageWrapper = document.getElementsByClassName("page-wrapper")[0];
        pageWrapper.setAttribute("data-sidebar-hidden", "hidden");
      }






    </script>
</body>
</html>
