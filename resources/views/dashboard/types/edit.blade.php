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
            <h2>Modificar tipo</h2>
        </div>
        
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
                <div><h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value="{{ $type->name }}" placeholder=""></div>
                @error('name') <small class="error-message">{{ $message }}</small> @enderror
                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection