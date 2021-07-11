@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Modificar Municipio</h2> <br>
    </div>
    <p class="subtitle">Verás estos cambios en <a
            href="{{ route('district-about', ['district' => auth()->user()->district->slug]) }}" target="_blank">sobre
            el departamento {{ $district->name }}</a></p>

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
            <h4>Foto:</h4><input class="@error('photos') error-input @enderror" type="file" accept="image/jpeg"
                id="imagesToCropInput">
        </div>
        @error('photos') <small class="error-message">{{ $message }}</small> @enderror

        <div class="cropper--container">
            <div id="previewGallery">
                @if ($district->image)
                <div class="singleImageCanvasContainer">
                    <img id="previewImage-0" src="{{ asset('storage/' . $district->image->path) }}"
                        alt="{{ $district->name }}">
                </div>
                @endif
            </div>
            <div id="cropContainer">
            </div>
        </div>

        @endif

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
        setAspectRatio(44/25)
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
    );
</script>
@endsection