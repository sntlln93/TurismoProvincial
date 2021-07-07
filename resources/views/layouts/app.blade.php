<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom CSS -->
    <link href="{{ asset('css/styles-web.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontello.css') }}" rel="stylesheet">    
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    @include('layouts.preference-variables')

    <title>Turismo @yield('title')</title>
</head>
<body>

    @include('layouts.header')
        
    @yield('content')

    @include('layouts.footer')

    <script src="{{ asset('js/menu-web.js') }}"></script>

    @yield('scripts')

</body>
</html>
