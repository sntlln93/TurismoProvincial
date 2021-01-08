@extends('dashboard.layouts.app')

<style>
        .error-message {
            color: red;
            margin: 0 1em 1em 0;
            font-weight: 500;
            text-align: right;
        }

        .error-input {
            border-color: red !important;
        }
    </style>

@section('content')
<main>
    <h2>Agregar fotos</h2>

    <div class="modal-body view">
        <form action="{{ url('panel-de-administracion/photos/'.$type.'/'.$id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div><h4>Fotos:</h4><input class="@error('photos') error-input @enderror"  type="file" name="photos[]" accept="image/png, .jpeg, .jpg"  multiple></div>
            @error('photos') <small class="error-message">{{ $message }}</small> @enderror

            <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
        </form>
    </div>
</main>
@endsection