@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Modificar dirección de {{ $address->addressable->name }}</h2>
    </div>

    <form action="{{ url('dashboard/addresses/'.$address->id) }}" method="POST" class="modal-body">
        @csrf @method('PUT')
        <div>
            <h4>Calle:</h4><input class="@error('street') error-input @enderror" type="text" name="street"
                value="{{ $address->street }}" placeholder="">
        </div>
        @error('street') <small class="error-message">{{ $message }}</small> @enderror
        <div>
            <h4>Altura:</h4><input class="@error('number') error-input @enderror" type="text" name="number"
                value="{{ $address->number }}" placeholder="">
        </div>
        @error('number') <small class="error-message">{{ $message }}</small> @enderror
        <div>
            <h4>Ciudad:</h4>
            <select class="@error('city_id') error-input @enderror" name="city_id" id="">
                @foreach($cities as $city)
                <option value="{{ $city->id }}" @if($city->id == $address->city_id) selected
                    @endif>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        @error('city_id') <small class="error-message">{{ $message }}</small> @enderror
        <div>
            <h4>Enlace de google maps:</h4><input class="@error('map_link') error-input @enderror" type="text"
                name="map_link" value="{{ $address->map_link }}" placeholder="">
        </div>
        @error('map_link') <small class="error-message">{{ $message }}</small> @enderror
        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection

@section('scripts')
@endsection