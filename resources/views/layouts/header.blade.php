<nav>
    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
    <div class="logo">
        <a href="{{ url($district->slug) }}"><img src="{{ ! Str::contains($district->preferences->logo, 'no-image') ? $district->preferences->logo : asset('img/Logo1-LR.png') }}" alt=""></a>
        <!-- <a href="index.html"><h3>Turismo Chilecito</h3></a> -->
    </div>
    <ul class="nav-links">
        <a href="{{ url($district->slug.'/lugares') }}"><li><i class="icon-picture"></i>Atractivos turísticos</li></a>
        <a href="{{ url($district->slug.'/alojamiento') }}"><li><i class="icon-bed"></i>Alojamiento</li></a>
        <a href="{{ url($district->slug.'/gastronomia') }}"><li><i class="icon-food"></i>Gastronomía</li></a>
        <a href="{{ url($district->slug.'/experiencias') }}"><li><i class="icon-child"></i>Experiencias</li></a>
        <a href="{{ url($district->slug.'/localidades') }}"><li><i class="icon-map-o"></i>Localidades del municipio</li></a>
        <a href="{{ url($district->slug.'/transporte') }}"><li><i class="icon-bus"></i>Transporte</li></a>
        {{-- <a href="{{ url($district->slug.'/para-agendar') }}"><li><i class="icon-phone"></i>Para agendar</li></a> --}}
        <a href="{{ url($district->slug.'/sobre-el-departamento') }}"><li><i class="icon-info"></i>Sobre el departamento</li></a>
    </ul>
</nav>