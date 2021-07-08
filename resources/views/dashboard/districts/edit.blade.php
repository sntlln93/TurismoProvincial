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

    .current--container {
        width: 75% !important;
        margin: 0 10px 0 auto;
    }

    .current--images {
        max-width: 300px;
        display: inline-block;
        position: relative;
        margin: 2px;
    }

    .current--images>img {
        width: 100%;
        height: auto;
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
        <h2>Modificar Municipio</h2>
    </div>
    <form action="{{ url('dashboard/districts/' . $district->id) }}" method="POST" enctype="multipart/form-data"
        class="modal-body">
        @csrf @method('PUT')
        <div>
            <h4>Intendente:</h4><input class="@error('mayor') error-input @enderror" type="text" name="mayor"
                value="{{ $district->mayor }}" placeholder="">
        </div>
        @error('mayor') <small class="error-message"> {{ $message }} </small> @enderror

        @if (Auth::user()->district_id)
        <div>
            <h4>Descripción:</h4>
            <textarea class="@error('description') error-input @enderror msjEdit" maxlength="1000" name="description"
                rows="10" placeholder="Escribe aquí la descripción">{{ $district->description }}</textarea>
        </div>
        @error('description') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <small class="contEdit">Cantidad de carácteres:
                {{ Str::of($district->description)->length() }}/1000</small>
        </div>

        <div id="croppedContainer">
            <h4>Foto:</h4><input class="@error('photo') error-input @enderror" type="file" id="imageCropFileInput"
                accept="image/jpeg">
        </div>
        @if ($district->image)
        <div class="current--container">
            <div class="current--images">
                <img id="district-image" src="{{ asset('storage/' . $district->image->path) }}"
                    alt="{{ $district->name }}">
            </div>
        </div>
        @endif
        @error('photo') <small class="error-message">{{ $message }}</small> @enderror

        @endif

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
<script src="{{ asset('js/contcharsedit.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="{{ asset('js/cropper.js') }}"></script>
<script>
    window.addEventListener('load', () => setAspectRatio(44/25));
</script>
@endsection