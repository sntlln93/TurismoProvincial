@extends('dashboard.layouts.app')

@section('styles')
<style>
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

        <div>
            <h4>Foto:</h4><input class="@error('photo') error-input @enderror" type="file" name="photo"
                accept="image/png, .jpeg, .jpg" multiple>
        </div>
        <div id="district-image-container">
            @if ($district->image)
            <img id="district-image" src="{{ asset('storage/' . $district->image->path) }}" alt="{{ $district->name }}">
            @endif
        </div>
        @error('photo') <small class="error-message">{{ $message }}</small> @enderror
        @endif

        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/contcharsedit.js') }}"></script>
@endsection