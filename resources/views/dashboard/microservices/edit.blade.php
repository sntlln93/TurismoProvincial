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
    <h2>Modificar microservicio</h2>

    <div class="modal-body view">
        <form action="{{ url('dashboard/services/'.$service->id) }}" method="POST">
            @csrf @method('PUT')
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

            <div>
                <h4>Enlace de google maps:</h4><input class="@error('map_link') error-input @enderror" type="text"
                    name="map_link" value="" placeholder="">
            </div>
            @error('map_link') <small class="error-message">{{ $message }}</small> @enderror

            <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
        </form>
    </div>
</main>
@endsection