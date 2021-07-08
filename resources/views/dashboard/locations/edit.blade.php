@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Modificar atractivo turistico</h2>
    </div>

    <div class="modal-body view">

        <form action="{{ url('dashboard/locations/'.$location->id) }}" method="POST">
            @csrf @method('PUT')

            <div>
                <h4>Nombre:</h4><input type="text" class="@error('name') error-input @enderror" name="name"
                    value="{{ $location->name }}" placeholder="">
            </div>
            @error('name') <small class="error-message">{{ $message }}</small> @enderror

            <!-- for con todas las localidades que estén cargadas -->

            <div>
                <h4>Calle:</h4><input type="text" class="@error('street') error-input @enderror" name="street"
                    value="{{ $location->address->street }}" placeholder="">
            </div>
            @error('street') <small class="error-message">{{ $message }}</small> @enderror

            <div>
                <h4>Altura:</h4><input type="number" class="@error('number') error-input @enderror" name="number"
                    value="{{ $location->address->number }}" placeholder="">
            </div>
            @error('number') <small class="error-message">{{ $message }}</small> @enderror

            <div>
                <h4>Enlace de google maps:</h4><input type="text" class="@error('map_link') error-input @enderror"
                    name="map_link" value="{{ $location->address->map_link }}" placeholder="">
            </div>
            @error('map_link') <small class="error-message">{{ $message }}</small> @enderror

            <!-- for con todas las localidades que estén cargadas -->
            <div>
                <h4>Localidad:</h4>
                <select name="city_id" type="text" class="@error('city_id') error-input @enderror">
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}" @if($city->id == $location->address->city_id) selected
                        @endif>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('city_id') <small class="error-message">El campo localidad es obligatorio</small> @enderror



            <div>
                <h4>Apertura:</h4><input type="time" class="@error('start') error-input @enderror" name="start"
                    value="{{ $location->start->format('h:i') }}">
            </div>
            @error('start') <small class="error-message">{{ $message }}</small> @enderror

            <div>
                <h4>Cierre:</h4><input type="time" class="@error('end') error-input @enderror" name="end"
                    value="{{ $location->end->format('h:i') }}">
            </div>
            @error('end') <small class="error-message">{{ $message }}</small> @enderror

            <div>
                <h4>Descripción:</h4>
                <textarea name="description" class="@error('description') error-input @enderror msjEdit" rows="6"
                    maxlength="1000" placeholder="Escribe aquí la descripción">{{ $location->description }}</textarea>
            </div>
            @error('description') <small class="error-message">{{ $message }}</small> @enderror

            <div>
                <small class="contEdit">Cantidad de carácteres:
                    {{ Str::of($location->description)->length() }}/1000</small>
            </div>

            <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/contcharsedit.js') }}"></script>

@endsection