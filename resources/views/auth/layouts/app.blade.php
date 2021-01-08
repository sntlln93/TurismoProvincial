<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom CSS -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontello.css') }}" rel="stylesheet">
    <title>Turismo La Rioja - Iniciar sesión</title>
    @yield("styles")
</head>
<body>

    <div class="login">
        <div class="login-container">

            <div class="login-title">
                <h2>Gestión de Contenidos Turísticos</h3>
                <h3>Gobierno de la Provincia de La Rioja</h2>
                <h4>Secretaría de Ciencia y Tecnología</h3>
                <div class="img-login">
                    <img src="{{ asset('img/Logo2-LR.png') }}" alt="">
                </div>
            </div>

            @yield('content')
        </div>
    </div>

</body>
</html>