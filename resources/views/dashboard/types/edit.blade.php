@extends('dashboard.layouts.app')

@section('content')
<main>
    <h2>Modificar tipo</h2>

    <form action="{{ url('dashboard/types/'.$type->id) }}" method="POST" class="modal-body">
        @csrf
        @method('PUT')
        <div>
            <h4>Tipo:</h4>
            <select name="type_id">
                @foreach($mtypes as $mtype)
                <option value="{{ $mtype->id }}" @if($mtype->id == $type->type_id) selected
                    @endif>{{ $mtype->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                value="{{ $type->name }}" placeholder="">
        </div>
        @error('name') <small class="error-message">{{ $message }}</small> @enderror
        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection