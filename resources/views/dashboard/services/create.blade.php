@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar servicio</h2>
    </div>

    <form action="{{ url('dashboard/services') }}" method="POST" class="modal-body" enctype="multipart/form-data"
        class="modal-body">
        @csrf
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value=""
                placeholder="">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Responsable:</h4><input class="@error('responsable') error-input @enderror" type="text"
                name="responsable" value="" placeholder="">
        </div>
        @error('responsable') <small class="error-message">{{ $message }}</small> @enderror

        @include('dashboard._partials.create-address')
        <div>
            <h4>Inicio:</h4><input class="@error('start') error-input @enderror" type="time" id="start" name="start"
                value="" placeholder="">
        </div>
        @error('start') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Fin:</h4><input class="@error('end') error-input @enderror" type="time" id="end" name="end" value=""
                placeholder="">
        </div>
        @error('end') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Tipo:</h4>
            <select class="@error('type_id') error-input @enderror" name="type_id">
                @foreach($types as $type)
                <optgroup label="{{ $type->name }}">
                    @foreach($type->subtypes as $subtype)
                    <option value="{{ $subtype->id }}">{{ $subtype->name }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
        </div>
        @error('type_id') <small class="error-message">{{ $message }}</small> @enderror

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