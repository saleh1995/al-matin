@php
    $language = app()->getlocale();
    $dir = $language == 'ar' ? 'rtl' : 'ltr';
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/almatin_group.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Almatin') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    @if (app()->getlocale() == 'ar')    
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif

    
</head>
<body>
    <div id="app">
        @if (Auth::user())
            @include('layouts.navbar')
        @endif

        <main class="py-4">
            @yield('content')
        </main>

        @if (Auth::user())
            <footer class="mt-5 pt-5">
                @include('layouts.footer')
            </footer>
        @endif
    </div>
</body>
</html>
