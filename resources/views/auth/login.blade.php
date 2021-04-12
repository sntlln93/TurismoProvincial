@extends('auth.layouts.app')

@section('styles')
    <style>
        .error-message {
            color: red;
            margin: 0 0 0 1em;
            font-weight: 500;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endsection

@section('content')
    <div class="login-user">
        <h2>INICIAR SESIÓN</h2>

        @if ($errors->any())
            <small class="error-message">Nombre de usuario o contraseña incorrectos.</small>
        @endif

        <form action="{{ url('login') }}" method="POST" autocomplete="off">
            @csrf

            <input style="display:none" ariahidden="true">
            <input type="password" style="display:none" ariahidden="true">

            <div class="input-group">
                <i class="icon-user"></i>
                <input class="dni-input" type="number" name="dni" placeholder="DNI">
            </div>
            <div class="input-group">
                <i class="icon-key-1"></i>
                <input type="password" name="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn-login">Entrar</button>

        </form>
    </div>
@endsection

@section('scripts')
<script>
    
</script>
@endsection