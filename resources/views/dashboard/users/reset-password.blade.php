@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2 style="margin-bottom: 2em">Blanquear contraseña de {{ $user->full_name }}</h2>
    </div>
    <div class="flex" id="flex">
        <div class="container-modal">
            <div class="modal-header flex">
                <h2>Colocá una nueva contraseña para este usuario</h2>
                <span class="close" id="close-edit">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{ url('reset-password/'.$user->id) }}" method="POST" class="modal-body">
                    @csrf @method('PUT')
                    <div><h4>Contraseña:</h4><input type="password" name="password" placeholder="Colocá una nueva contraseña para este usuario"></div>
                    <div><h4>Confirmación:</h4><input type="password" name="password_confirmation" placeholder="Repetí la contraseña, ambas deben coincidir"></div>
                    @if($errors->any())
                        <small class="error-message">Ambos campos son requeridos y deben coincidir</small>
                    @endif
                    <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
                </form>
            </div>
        </div>
    </div>
</main>
@endsection