@extends('dashboard.layouts.app')

@section('content')
<main>
    <h2>Modificar microservicio</h2>

    <form action="{{ url('dashboard/services/'.$service->id) }}" method="POST" class="modal-body">
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
</main>
@endsection