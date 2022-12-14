<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>شركة المتين</title>

  {{-- bootstrap style --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  {{-- custom style --}}
  @yield('style')
</head>
<body>
  <header>
    @include('layout.header')
  </header>

  @yield('content')

  <footer>
    @include('layout.footer')
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>