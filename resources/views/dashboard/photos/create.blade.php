@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar fotos</h2>
    </div>

    <div class="modal-body view">
        <form action="{{ url('panel-de-administracion/photos/'.$type.'/'.$id) }}" method="POST" enctype="multipart/form-data" class="modal-body">
            @csrf
            <div><h4>Fotos:</h4><input class="@error('photos') error-input @enderror"  type="file" name="photos[]" accept="image/png, .jpeg, .jpg"  multiple></div>
            @error('photos') <small class="error-message">{{ $message }}</small> @enderror

            <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
        </form>
    </div>
</main>
@endsection