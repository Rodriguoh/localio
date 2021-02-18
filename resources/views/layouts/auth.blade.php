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
    <title>Starter template - Halfmoon</title>

    <!-- Halfmoon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />
    <!--
    Or,
    Use the following (no variables, supports IE11):
    <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon.min.css" rel="stylesheet" />
    Learn more: https://www.gethalfmoon.com/docs/customize/#notes-on-browser-compatibility
  -->
</head>
<body class="">
    @include('layouts.home.navigation')
    <div class="text-center d-flex align-items-center justify-content-center" style="height:100%">
        <div style="width: 100%;max-width: 330px;padding: 15px;margin: 0 auto;">
            @yield('content')
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
</body>
</html>
