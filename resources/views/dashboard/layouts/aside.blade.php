<aside>
    <ul>
        @if(Auth::user()->district_id)
            @if(Auth::user()->role->name == "Gestor de Contenidos")
                <li class="{{ Str::contains(Route::currentRouteName(), 'cities') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/cities') }}"><i class="icon-location"></i>Localidades</a>
                </li>
                <li class="{{ Str::contains(Route::currentRouteName(), 'location') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/locations') }}"><i class="icon-picture"></i>Atractivos turísticos</a>
                </li>
                <li class="{{ Str::contains(Route::currentRouteName(), 'activities') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/activities') }}"><i class="icon-child"></i>Experiencias</a>
                </li>
                <li class="{{ Str::contains(Route::currentRouteName(), 'services') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/services') }}"><i class="icon-th-large"></i>Servicios</a>
                </li>
                
            @elseif(Auth::user()->role->name == "Admin Municipalidad")
                <!-- Para rol "admin de municipio" -->
                <li class="{{ Str::contains(Route::currentRouteName(), 'preference') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/preferences') }}"><i class="icon-cog"></i>Preferencias</a>
                </li>
                <!-- Para rol "provincia" y "admin de municipio" -->
                <li class="{{ Str::contains(Route::currentRouteName(), 'user') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/users') }}"><i class="icon-users"></i>Usuarios</a>
                </li>
            @endif
        @else
            @if(Auth::user()->role->name == "Admin Provincia")
                <li class="{{ Str::contains(Route::currentRouteName(), 'user') ? 'aside-link-active' : null}}">
                    <a href="{{ url('panel-de-administracion/users') }}"><i class="icon-users"></i>Usuarios</a>
                </li>
            @endif
            <!-- Solo para el rol "provincia" -->
            <!-- <li><a href="province/userprovince.html"><i class="icon-users"></i>Usuarios</a></li> -->
            <li class="{{ Str::contains(Route::currentRouteName(), 'district') ? 'aside-link-active' : null}}">
                <a href="{{ url('panel-de-administracion/districts') }}"><i class="icon-map-o"></i>Municipios</a>
            </li>
        @endif
    </ul>
</aside>