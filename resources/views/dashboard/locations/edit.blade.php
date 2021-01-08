@extends('dashboard.layouts.app')

@section('styles')
    <style>
        .error-message {
            color: red;
            margin: 0 0 1em 0;
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
        <h2>Modificar producto turistico</h2>

        <div class="modal-body view">

            <form action="{{ url('panel-de-administracion/locations/'.$location->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div><h4>Nombre:</h4><input type="text" class="@error('name') error-input @enderror" name="name" value="{{ $location->name }}" placeholder=""></div>
                @error('name') <small class="error-message">{{ $message }}</small> @enderror

                <!-- for con todas las localidades que estén cargadas -->

                <div>
                    <h4>Calle:</h4><input type="text" class="@error('street') error-input @enderror" name="street" value="{{ $location->address->street }}" placeholder="">
                </div>
                @error('street') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Altura:</h4><input type="number" class="@error('number') error-input @enderror" name="number" value="{{ $location->address->number }}" placeholder=""></div>
                @error('number') <small class="error-message">{{ $message }}</small> @enderror

                <!-- for con todas las localidades que estén cargadas -->
                <div><h4>Localidad:</h4>
                    <select name="city_id" type="text" class="@error('city_id') error-input @enderror">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @if($city->id == $location->address->city_id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                    </select>  
                </div>
                @error('city_id') <small class="error-message">El campo localidad es obligatorio</small> @enderror



                <div><h4>Apertura:</h4><input type="time" class="@error('start') error-input @enderror" name="start" value="{{ $location->start->format('h:i') }}"></div>
                @error('start') <small class="error-message">{{ $message }}</small> @enderror

                <div><h4>Cierre:</h4><input type="time" class="@error('end') error-input @enderror" name="end" value="{{ $location->end->format('h:i') }}"></div>
                @error('end') <small class="error-message">{{ $message }}</small> @enderror

                <div
                    ><h4>Descripción:</h4>
                    <textarea name="description" class="@error('description') error-input @enderror" rows="6" placeholder="Escribe aquí la descripción">{{ $location->description }}</textarea>
                </div>
                @error('description') <small class="error-message">{{ $message }}</small> @enderror

                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection