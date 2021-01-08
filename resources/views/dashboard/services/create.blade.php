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
        <h2>Agregar servicio</h2>

        <div class="modal-body newservice">
            <form action="{{ url('panel-de-administracion/services') }}" method="POST" class="modal-body" enctype="multipart/form-data">
                @csrf
                <div><h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name" value="" placeholder=""></div>
                @error('name') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Responsable:</h4><input class="@error('responsable') error-input @enderror" type="text" name="responsable" value="" placeholder=""></div>
                @error('responsable') <small class="error-message">{{ $message }}</small> @enderror

                @include('dashboard._partials.create-address')
                <div><h4>Inicio:</h4><input class="@error('start') error-input @enderror" type="time" id="start" name="start" value="" placeholder=""></div>
                @error('start') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Fin:</h4><input class="@error('end') error-input @enderror" type="time" id="end" name="end" value="" placeholder=""></div>
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

                <div><h4>Fotos:</h4><input class="@error('photos') error-input @enderror" type="file" name="photos[]" accept="image/png, .jpeg, .jpg"  multiple></div>
                @error('photos') <small class="error-message">{{ $message }}</small> @enderror

                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection