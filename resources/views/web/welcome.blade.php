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
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">

    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    <title>Turismo - Provincia de La Rioja</title>
</head>
<body> 

    <header class="principal-web">
        <div class="logo">
            <img src="{{ asset('img/Logo1-LR.png') }}" alt="">
        </div>
        <div class="logo">
            <a><h3>Turismo Municipal</h3></a>
        </div>
        <!-- <div class="btn-down">
            <a href="#principal"> <i class="icon-angle-down"></i></a>           
        </div> -->
    </header>
    
    <main class="principal" >
        <h2 class="welcome">¡BIENVENID@!</h2>
        <p>Seleccione un departamento para entrar a su página web y encontrar toda la oferta turistica que tiene para usted.</p>

        <div class="districts">
            @foreach($districts as $district)
            <a class="information" href="{{ url($district->slug) }}">
                <img class="image" src="{{ $district->image ? asset('storage/'.$district->image->path) : asset('img/no-image.png') }}" alt="{{ $district->slug }}">
                <div class="name">
                    <h2>{{ $district->name }}</h2>
                </div>
            </a>

            @endforeach
        </div>               
    </main>

    <footer class="principal-footer">
        <div class="cyt">
            <img src="{{ asset('img/Logo-Sec.png') }}" alt=""> </br>
            <i class="icon-location"></i>El chacho N° 65 - B° Matadero </br>
            <div class="social-media">
                <a href="https://www.facebook.com/LaRiojaCienciaYTecnologia/" target="_blank"><i class="icon-facebook"></i></a>
            </div>
        </div>

        <div class="min">
            <img src="{{ asset('img/Logo-Min.png') }}" alt=""> </br>
            <i class="icon-location"></i>Hipólito Yrigoyen 152
            <div class="social-media">
                <a href="https://mintrabajoindustria.larioja.gob.ar/" target="_blank"><i class="icon-globe"></i></a>
                <a href="https://twitter.com/mintrabajo_lr?s=09" target="_blank"><i class="icon-twitter"></i></a>
                <a href="https://www.facebook.com/MinTrabajoEmpleoIndustria" target="_blank"><i class="icon-facebook"></i></a>
            </div>
        </div>

        <div class="gob">
            <img src="{{ asset('img/Logo4-LR.png') }}" alt=""> </br>
            <i class="icon-location"></i>25 de Mayo y San Nicolas de Bari
            <div class="social-media">
                <a href="https://www.larioja.gov.ar/" target="_blank"><i class="icon-globe"></i></a>
                <a href="https://twitter.com/GobDeLaRioja" target="_blank"><i class="icon-twitter"></i></a>
                <a href="https://www.facebook.com/gobiernodelarioja/" target="_blank"><i class="icon-facebook"></i></a>
                <a href="https://www.instagram.com/gobiernodelarioja/" target="_blank"><i class="icon-instagram"></i></a>
            </div>
        </div>
        
        <div class="developers">
            &copy; Las imágenes de este sitio pueden estar sujetas a derechos de autor.
        </div>
    </footer>
    
    <script src="{{ asset('js/buttonDown.js') }}"></script>
</body>
</html>