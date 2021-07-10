@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar experiencia</h2>
    </div>
    <form action="{{ url('dashboard/activities') }}" method="POST" enctype="multipart/form-data" class="modal-body">
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

        <div>
            <h4>Precio:</h4><input class="@error('amount') error-input @enderror" type="number" name="amount" value=""
                placeholder="">
        </div>
        @error('amount') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Atractivo turístico:</h4>
            <select name="location_id" id="" class="@error('location_id') error-input @enderror">
                <option></option>
                @foreach($locations as $address)
                @php($location = $address->addressable)
                <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        @error('location_id') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Inicio:</h4><input class="@error('start') error-input @enderror" type="datetime-local" name="start"
                value="" placeholder="">
        </div>
        @error('start') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Fin:</h4><input class="@error('end') error-input @enderror" type="datetime-local" name="end" value=""
                placeholder="">
        </div>
        @error('end') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Descripción:</h4>
            <textarea class="@error('description') error-input @enderror" name="description" rows="6"
                placeholder="Escribe aquí la descripción"></textarea>
        </div>
        @error('description') <small class="error-message">{{ $message }}</small> @enderror

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