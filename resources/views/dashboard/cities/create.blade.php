@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">

<style>
    .error-message {
        color: red;
        margin: 0 0 1em 0;
        font-weight: 500;
        text-align: right;
    }

    .error-input {
        border-color: red !important;
    }

    .cropper--container {
        width: 75% !important;
        margin-right: 10px;
        margin-left: auto;
        display: flex;
        flex-direction: column;
    }

    #galleryImages,
    #cropper {
        width: 100%;
        float: left;
    }

    canvas {
        max-width: 100%;
        display: inline-block;
    }

    #cropperImg {
        /*max-width: 0;
    max-height: 0;*/
    }

    #cropImageBtn {
        display: none;
        margin: .6em;
        padding: .6em;
        border-radius: 5px;
        box-shadow: 10px;
        background: #4032ac;
        border: 0;
        color: var(--second-color);
    }

    img {
        width: 100%;
    }

    .img-preview {
        float: left;
    }

    .singleImageCanvasContainer {
        max-width: 300px;
        display: inline-block;
        position: relative;
        margin: 2px;
    }

    .singleImageCanvasCloseBtn {
        position: absolute !important;
        top: 5px;
        right: 5px;
        display: none;
        margin: .6em;
        padding: .6em;
        border-radius: 5px;
        box-shadow: 10px;
        background: var(--first-color);
        color: var(--second-color);
        border: 0;
    }
</style>
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar localidad</h2>
    </div>

    <form action="{{ url('dashboard/cities') }}" method="POST" class="modal-body">
        @csrf
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value=""
                placeholder="Nombre de la localidad">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Descripción:</h4>
            <textarea class="@error('description') error-input @enderror msj" name="description" maxlength="1000"
                rows="5" placeholder="Escribí una descripción de la localidad"></textarea>
        </div>
        @error('description') <small class="error-message">{{ $message }}</small> @enderror
        <label class="cont">Cantidad de carácteres: 0/1000</label>


        <div id="croppedContainer">
            <h4>Foto:</h4><input class="@error('photo') error-input @enderror" type="file" accept="image/jpeg"
                id="imageCropFileInput">
        </div>
        @error('photo') <small class="error-message">{{ $message }}</small> @enderror

        <div class="cropper--container">
            <input type="hidden" id="croppedImgs">
            <div id="galleryImages"></div>
            <div id="cropper">
                <canvas id="cropperImg" width="0" height="0"></canvas>
            </div>
            <button class="cropImageBtn cropBtn" id="cropImageBtn">Recortar</button>
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