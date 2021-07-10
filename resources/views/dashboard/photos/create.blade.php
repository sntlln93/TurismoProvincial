@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar fotos</h2>
    </div>

    <form action="{{ url('dashboard/photos/'.$type.'/'.$id) }}" method="POST" enctype="multipart/form-data"
        class="modal-body">
        @csrf
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="{{ asset('js/cropper.js') }}"></script>
@endsection