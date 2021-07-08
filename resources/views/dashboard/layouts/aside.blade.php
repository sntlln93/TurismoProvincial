<aside>
    <ul>
        @if (Auth::user()->district_id)
        <li class="{{ Str::contains(Route::currentRouteName(), 'cities') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/cities') }}"><i class="icon-location"></i>Localidades</a>
        </li>
        <li class="{{ Str::contains(Route::currentRouteName(), 'location') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/locations') }}"><i class="icon-picture"></i>Atractivos
                turísticos</a>
        </li>
        <li class="{{ Str::contains(Route::currentRouteName(), 'activities') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/activities') }}"><i class="icon-child"></i>Experiencias</a>
        </li>
        <li class="{{ Str::contains(Route::currentRouteName(), 'services') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/services') }}"><i class="icon-th-large"></i>Servicios</a>
        </li>
        <li class="{{ Str::contains(Route::currentRouteName(), 'microservices') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/microservices') }}"><i class="icon-info"></i>Microservicios</a>
        </li>
        <li class="{{ Str::contains(Route::currentRouteName(), 'districts') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/districts/' . Auth::user()->district_id . '/edit') }}"><i
                    class="icon-map-o"></i>Modificar Municipio</a>
        </li>

        <!-- Para rol "admin de municipio" -->
        <li class="{{ Str::contains(Route::currentRouteName(), 'preference') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/preferences') }}"><i class="icon-cog"></i>Preferencias</a>
        </li>
        <!-- Para rol "provincia" y "admin de municipio" -->
        <li class="{{ Str::contains(Route::currentRouteName(), 'user') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/users') }}"><i class="icon-users"></i>Usuarios</a>
        </li>
        @else
        <li class="{{ Str::contains(Route::currentRouteName(), 'user') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/users') }}"><i class="icon-users"></i>Usuarios</a>
        </li>
        <!-- Solo para el rol "provincia" -->
        <!-- <li><a href="province/userprovince.html"><i class="icon-users"></i>Usuarios</a></li> -->
        <li class="{{ Str::contains(Route::currentRouteName(), 'district') ? 'aside-link-active' : null }}">
            <a href="{{ url('dashboard/districts') }}"><i class="icon-map-o"></i>Municipios</a>
        </li>
        @endif
    </ul>
</aside>