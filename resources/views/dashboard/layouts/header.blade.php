<header>
    <div class="logo">
        <a href="{{ url('panel-de-administracion') }}"><img src="{{ asset('img/Logo1-LR.png') }}"></a>
    </div>
    <div class="iuser">
        <i class="icon-user-circle"></i>
    </div>
    <ul class="nav-links">
        <li style="padding: 10px;"><a></i>¡Hola, {{ Auth::user()->name }}! <!-- name del user actual --></a></li> 
        <li class="menu"><a href="{{ url('change-password') }}"><i class="icon-cog"></i>Cambiar contraseña</a></li>
        <li class="menu"><a href="{{ url('logout') }}"><i class="icon-logout"></i>Cerrar sesión</a></li>
    </ul>
</header>