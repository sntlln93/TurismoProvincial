<header>
    <div class="logo">
        <a href="{{ url('panel-de-administracion') }}"><img src="{{ asset('img/Logo1-LR.png') }}"></a>
    </div>
    <div class="iuser">
        <div class="user">
        @if (Auth::user()->district_id)
            <p>{{ Auth::user()->name }} - Municipalidad de {{ Auth::user()->district->name}}</p>
        @else
            <p>{{ Auth::user()->name }} - Usuario Provincia</p>
        @endif
        </div>
        <i class="icon-user-circle"></i>
    </div>
    <ul class="nav-links">
        <li class="nameUser"><a></i>¡Hola, {{ Auth::user()->name }}! <!-- name del user actual --></a></li> 
        @if (Auth::user()->district_id)
            <li class="rolUser">Municipalidad de {{ Auth::user()->district->name}}</li>
        @else
            <li class="rolUser">Usuario Provincia</li> 
        @endif
        <li class="menu"><a href="{{ url('change-password') }}"><i class="icon-cog"></i>Cambiar contraseña</a></li>
        <li class="menu"><a href="{{ url('logout') }}"><i class="icon-logout"></i>Cerrar sesión</a></li>
    </ul>
</header>

<style>
.nav-links .nameUser {
    font-size: 14px;
    padding: 10px 10px 2px 10px;
}

.nav-links .rolUser {
    font-size: 12px;
    padding: 0 20px;
    color: white;
    font-weight: 500;
}
</style>