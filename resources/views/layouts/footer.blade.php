<footer>
        <div class="gob">
            <img src="{{ asset('img/Logo4-LR.png') }}" alt=""> </br>
            <i class="icon-location"></i>25 de Mayo y San Nicolas de Bari, Capital
            <div class="social-media">
                <a href="https://www.larioja.gov.ar/" target="_blank"><i class="icon-globe"></i></a>
                <a href="https://twitter.com/GobDeLaRioja" target="_blank"><i class="icon-twitter"></i></a>
                <a href="https://www.facebook.com/gobiernodelarioja/" target="_blank"><i class="icon-facebook"></i></a>
                <a href="https://www.instagram.com/gobiernodelarioja/" target="_blank"><i class="icon-instagram"></i></a>
            </div>
        </div>

         <div class="cyt">
            Sec. de Ciencia y Tecnología </br>
            <i class="icon-location"></i>El chacho N° 67- B° Matadero, Capital </br>
            <div class="social-media">
                <a href="https://www.facebook.com/LaRiojaCienciaYTecnologia/" target="_blank"><i class="icon-facebook"></i></a>
            </div>
        </div>

        <div class="information gob">
        @if(! Str::contains($district->preferences->logo, 'no-image'))
        <img src="{{ $district->preferences->logo }}" alt=""></br>

        @endif

            Municipalidad de La Rioja<br/>
            Intendente: Inés Brizuela Idoria</br>
            <i class="icon-location"></i>Santa Fe N° 951
            <div class="social-media">
                <a href="http://municipiolarioja.gob.ar/" target="_blank"><i class="icon-globe"></i></a>
                <a href="https://twitter.com/municipalidadlr" target="_blank"><i class="icon-twitter"></i></a>
                <a href="https://www.facebook.com/municipalidaddelarioja?_rdc=2&_rdr" target="_blank"><i class="icon-facebook"></i></a>
                <a href="https://www.instagram.com/municipalidadlarioja/?hl=es-la" target="_blank"><i class="icon-instagram"></i></a>
            </div>
        </div>
        <div class="developers">
            &copy; Las imágenes de este sitio pueden estar sujetas a derechos de autor.
        </div>
    </footer>
