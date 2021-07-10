@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar atractivo turístico</h2>
    </div>

    <form action="{{ route('locations.store') }}" method="POST" class="modal-body">
        @csrf
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value=""
                placeholder="">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror

        @include('dashboard._partials.create-address')
        <div>
            <h4>Apertura:</h4><input class="@error('start') error-input @enderror" type="time" name="start" value="">
        </div>
        @error('start') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Cierre:</h4><input class="@error('end') error-input @enderror" type="time" name="end" value="">
        </div>
        @error('end') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Descripción:</h4>
            <textarea name="description" class="@error('description') error-input @enderror msj" rows="6"
                maxlength="1000" placeholder="Escribe aquí la descripción"></textarea>
        </div>
        @error('description') <small class="error-message">{{ $message }}</small> @enderror
        <label class="cont">Cantidad de carácteres: 0/1000</label>

        <div id="croppedContainer">
            <h4>Foto:</h4><input class="@error('photos') error-input @enderror" type="file" accept="image/jpeg"
                id="imagesToCropInput" multiple>
        </div>
        @error('photos') <small class="error-message">{{ $message }}</small> @enderror

        <div class="cropper--container">
            <div id="previewGallery"></div>
            <div id="cropContainer">
            </div>
        </div>

        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/contchar.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="{{ asset('js/cropper.js') }}"></script>
@endsection