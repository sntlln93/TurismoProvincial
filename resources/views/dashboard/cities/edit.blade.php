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
        <h2>Modificar localidad</h2>

        <div class="modal-body view">
            <form action="{{ url('panel-de-administracion/cities/' . $city->id) }}" method="POST">
                @csrf @method('PUT')
                <div>
                    <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                        value="{{ $city->name }}" placeholder="Nombre de la localidad">
                </div>
                @error('name') <small class="error-message">{{ $message }}</small> @enderror

                <div>
                    <h4>Descripción:</h4>
                    <textarea class="@error('description') error-input @enderror msjEdit" name="description"
                        maxlength="1000" rows="6"
                        placeholder="Escribí una descripción">{{ $city->description }}</textarea>
                </div>
                @error('description') <small class="error-message">{{ $message }}</small> @enderror

                <div>
                    <small class="contEdit">Cantidad de carácteres:
                        {{ Str::of($city->description)->length() }}/1000</small>
                </div>
                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection
