@extends('dashboard.layouts.app')

@section('content')
<main>
    <h2>Colocá tu nueva contraseña</h2>

    <div class="modal-body view">
        <form action="{{ url('change-password/') }}" method="POST">
            @csrf @method('PUT')
            <div><h4>Contraseña:</h4><input type="password" name="password" placeholder="Colocá una nueva contraseña"></div>
            <div><h4>Confirmación:</h4><input type="password" name="password_confirmation" placeholder="Repetí la contraseña, ambas deben coincidir"></div>
            <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
        </form>
    </div>
</main>
@endsection