<footer>
    <div class="cyt">
        <img src="{{ asset('img/Logo-Sec.png') }}" alt=""> </br>
        <i class="icon-location"></i>El chacho N° 67- B° Matadero </br>
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

    <div class="information gob">
    @if(! Str::contains($district->preferences->logo, 'no-image'))
    <img src="{{ $district->preferences->logo }}" alt=""></br>

    @endif
            Municipalidad de {{ $district->name }}<br/>
            Intendente: {{ $district->mayor }}</br>
        <!-- <i class="icon-location"></i>Santa Fe N° 951
        <div class="social-media">
            <a href="http://municipiolarioja.gob.ar/" target="_blank"><i class="icon-globe"></i></a>
            <a href="https://twitter.com/municipalidadlr" target="_blank"><i class="icon-twitter"></i></a>
            <a href="https://www.facebook.com/municipalidaddelarioja?_rdc=2&_rdr" target="_blank"><i class="icon-facebook"></i></a>
            <a href="https://www.instagram.com/municipalidadlarioja/?hl=es-la" target="_blank"><i class="icon-instagram"></i></a>
        </div> -->
    </div>

    <div class="developers">
        &copy; Las imágenes de este sitio pueden estar sujetas a derechos de autor.
    </div>

    </footer>
