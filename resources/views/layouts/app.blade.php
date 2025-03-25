<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>
        
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

        <!-- bootstrap 5 css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/105a4d9adc.js" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/small-style.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/flash-message.js') }}" defer></script>
        {{-- <script src="{{ asset('js/nav.js') }}" defer></script> --}}
        @vite('resources/js/app.js')

    </head>

    <body style="background-color: #ffffffbe;">
        <div id="app">
            <nav id="navbar"
                class="navbar navbar-expand-lg navbar-light py-1 fixed-top shadow-sm border-black border-bottom"
                style="background-color: #f3f3f3d8;">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('/storage/app/public/images/favicon/favicon-32x32.png') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @include('shared.navbar')
                </div>
            </nav>

            <main class="mt-4">
                <!-- Dashboard Card -->
                @include('layouts.message')
                @yield('content')
            </main>
        </div>
    </body>
    @include('shared.footer')

</html>
