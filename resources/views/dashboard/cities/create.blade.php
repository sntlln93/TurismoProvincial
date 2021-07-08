@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">

<style>
    button#cropBtn {
        margin: 1em;
        padding: 1em;
        background: var(--second-color);
        display: none;
    }

    .img--container {
        width: 75% !important;
        margin-right: 10px;
        margin-left: auto;
        display: flex;
        flex-direction: column;
    }

    /* Ensure the size of the image fit the container perfectly */
    img#inputImage {
        /* This rule is very important, please don't ignore this */
        max-width: 100% !important;
        width: 100% !important;
    }

    img#croppedImage {
        max-width: 100% !important;
        width: 100% !important;
        height: auto;
    }

    .hide {
        display: none !important;
    }

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


        <div>
            <h4>Foto:</h4><input class="@error('photo') error-input @enderror" type="file" accept="image/jpeg"
                id="photo">
            <input id="croppedImageInput" type="hidden" name="photo">
        </div>
        @error('photo') <small class="error-message">{{ $message }}</small> @enderror

        <div class="img--container">
            <img id="inputImage">
            <button id="cropBtn">Recortar</button>
            <img id="croppedImage">
        </div>

        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/contchar.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    const photoInput = document.getElementById('photo');
    const inputImage = document.getElementById('inputImage');
    const cropBtn = document.getElementById('cropBtn');
    const croppedImage = document.getElementById('croppedImage');
    const croppedImageInput = document.getElementById('croppedImageInput');

    const showCropper = () => {
        cropBtn.style.display = "block";
        
        const aspectRatio = 16 / 9;
        const options = {
            viewMode: 1,
            restore: true,
            aspectRatio: aspectRatio,
            movable: false,
            dragMode: 'move',
            cropBoxMovable: true,
            cropBoxResizable: false,
            zoomOnWheel: false
        };
        
        inputImage.src = URL.createObjectURL(photoInput.files[0]);
        const cropper = new Cropper(inputImage, options);

        const crop = (e) => {
            e.preventDefault();

            const blob = cropper.getCroppedCanvas().toDataURL('image/jpeg');
            
            croppedImage.src = blob;
            croppedImageInput.value = blob;
        }

        cropBtn.addEventListener('click', (e) => crop(e));
    }

    photoInput.addEventListener('change', showCropper);
</script>

@endsection