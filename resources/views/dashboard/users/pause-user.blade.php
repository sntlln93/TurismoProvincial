@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Pausar usuario {{ $user->full_name }}</h2>
        <p style="margin-bottom: 2em">Pausar a este usuario impedirá que realice acciones en el sistema</p>
    </div>
    <div class="flex" id="flex">
        <div class="container-modal">
            <div class="modal-header flex">
                <h2>Pausar usuario</h2>
                <span class="close" id="close-edit">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{ url('dashboard/pause-user/'.$user->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div>
                        <h4>Motivo:</h4><input type="text" name="paused_for" placeholder="Indicá el motivo">
                    </div>
                    <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection