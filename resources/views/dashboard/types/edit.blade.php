@extends('dashboard.layouts.app')

@section('content')
    <main>
        <h2>Modificar tipo</h2>

        <div class="modal-body view">
            <form action="{{ url('panel-de-administracion/types/'.$type->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div><h4>Tipo:</h4>
                    <select name="type_id">
                        @foreach($mtypes as $mtype)
                            <option value="{{ $mtype->id }}" @if($mtype->id == $type->type_id) selected @endif>{{ $mtype->name }}</option>
                        @endforeach
                    </select>  
                </div>
                <div><h4>Nombre:</h4><input type="text" name="name" value="{{ $type->name }}" placeholder=""></div>
                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection