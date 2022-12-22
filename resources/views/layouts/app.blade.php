<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="Boom Solutions" />
    <meta content="" name="Ing. Luis Campos - campos.luis19@gmail.com" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('src/icon/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/icon/feather/css/feather.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/style.css') }}">

</head>
<body class="fix-menu">

    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>

    @yield('content')

    <script type="text/javascript" src="{{ asset('src/plugins/jquery/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>

    <script type="text/javascript" src="{{ asset('src/plugins/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/modernizr/js/css-scrollbars.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('src/plugins/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('src/plugins/jquery-i18next/js/jquery-i18next.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('src/js/login.js') }}"></script>
</body>
</html>
