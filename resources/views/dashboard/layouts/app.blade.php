<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontello.css') }}" rel="stylesheet">
    @yield('styles')
    <title>Turismo La Rioja - Panel de Control</title>
</head>
<body>
  
    @include('dashboard.layouts.header')
    
    @include('dashboard.layouts.aside')
    
    @yield('content')

    @include('dashboard.layouts.footer')
    
    <script src="{{ asset('js/dashboard.js') }}"></script>

    @yield('scripts')
</body>
</html>