@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Modificar servicio</h2>
    </div>

    <form action="{{ url('dashboard/services/'.$service->id) }}" method="POST" class="modal-body">
        @csrf @method('PUT')
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                value="{{ $service->name }}" placeholder="">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Responsable:</h4><input class="@error('responsable') error-input @enderror" type="text"
                name="responsable" value="{{ $service->responsable }}" placeholder="">
        </div>
        @error('responsable') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Inicio:</h4><input class="@error('start') error-input @enderror" type="time" id="start" name="start"
                value="{{ $service->start }}" placeholder="">
        </div>
        @error('start') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Fin:</h4><input class="@error('end') error-input @enderror" type="time" id="end" name="end"
                value="{{ $service->end }}" placeholder="">
        </div>
        @error('end') <small class="error-message">{{ $message }}</small> @enderror

        <div>
            <h4>Tipo:</h4>
            <select class="@error('type_id') error-input @enderror" name="type_id">
                @foreach($types as $type)
                <optgroup label="{{ $type->name }}">
                    @foreach($type->subtypes as $subtype)
                    <option value="{{ $subtype->id }}" @if ($subtype->id == $service->type_id) selected
                        @endif>{{ $subtype->name }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
        </div>
        @error('type_id') <small class="error-message">{{ $message }}</small> @enderror

        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection