@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Modificar localidad</h2>
    </div>

    <form action="{{ url('dashboard/cities/' . $city->id) }}" method="POST" enctype="multipart/form-data" class="modal-body">
        @csrf @method('PUT')
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                value="{{ $city->name }}" placeholder="Nombre de la localidad">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Descripción:</h4>
            <textarea class="@error('description') error-input @enderror msjEdit" name="description"
                maxlength="1000" rows="6" placeholder="Escribí una descripción">{{ $city->description }}</textarea>
        </div>
        @error('description') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <small class="contEdit">Cantidad de carácteres:
                {{ Str::of($city->description)->length() }}/1000</small>
        </div>

        <div>
            <h4>Foto:</h4><input class="@error('photo') error-input @enderror" type="file" name="photo"
                accept="image/png, .jpeg, .jpg" multiple>
        </div>
        <div id="city-image-container">
            @if ($city->image)
            <img id="city-image" src="{{ asset('storage/' . $city->image->path) }}" alt="{{ $city->name }}">
            @endif
        </div>
        @error('photo') <small class="error-message">{{ $message }}</small> @enderror

        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection