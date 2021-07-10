@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2 style="margin-bottom: 2em">Blanquear contraseña de {{ $user->full_name }}</h2>
    </div>

    <form action="{{ url('reset-password/'.$user->id) }}" method="POST" class="modal-body" style="width: 50%">
        @csrf @method('PUT')
        <div><h4>Contraseña:</h4><input type="password" name="password" placeholder="Colocá una nueva contraseña para este usuario"></div>
        <div><h4>Confirmación:</h4><input type="password" name="password_confirmation" placeholder="Repetí la contraseña, ambas deben coincidir"></div>
        @if($errors->any())
            <small class="error-message">Ambos campos son requeridos y deben coincidir</small>
        @endif
        <button type="submit" class="save" style="width: 50%;">Guardar<i class="icon-floppy"></i>    
    </form>
</main>
@endsection