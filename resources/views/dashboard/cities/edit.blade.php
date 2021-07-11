@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Modificar localidad</h2>
    </div>

    <form action="{{ url('dashboard/cities/' . $city->id) }}" method="POST" enctype="multipart/form-data"
        class="modal-body">
        @csrf @method('PUT')
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                value="{{ $city->name }}" placeholder="Nombre de la localidad">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Descripción:</h4>
            <textarea class="@error('description') error-input @enderror msjEdit" name="description" maxlength="1000"
                rows="6" placeholder="Escribí una descripción">{{ $city->description }}</textarea>
        </div>
        @error('description') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <small class="contEdit">Cantidad de carácteres:
                {{ Str::of($city->description)->length() }}/1000</small>
        </div>

        <div id="croppedContainer">
            <h4>Foto:</h4><input class="@error('photos') error-input @enderror" type="file" accept="image/jpeg"
                id="imagesToCropInput">
        </div>
        @error('photos') <small class="error-message">{{ $message }}</small> @enderror

        <div class="cropper--container">
            <div id="previewGallery">
                @if ($city->image)
                <div class="singleImageCanvasContainer">
                    <img id="previewImage-0" src="{{ asset('storage/' . $city->image->path) }}" alt="{{ $city->name }}">
                </div>
                @endif
            </div>
            <div id="cropContainer">
            </div>
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
    const initialPreviewImage = document.getElementById('previewImage-0');

    window.addEventListener("load", () => {
      fetch(initialPreviewImage.src)
      .then(response => {
         return response.blob();
      })
      .then(blob => {
        toCropImages = [{ index: '0', photo: blob }];
      });
   });

    initialPreviewImage.addEventListener("click", () =>
        showCropper("previewImage-0")
    )
</script>
@endsection