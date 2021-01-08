@extends('dashboard.layouts.app')

@section('content')
    <main>
        <h2>Modificar dirección de {{ $address->addressable->name }}</h2>

        <div class="modal-body view">
            <form action="{{ url('panel-de-administracion/addresses/'.$address->id) }}" method="POST">
                @csrf @method('PUT')
                <div><h4>Calle:</h4><input type="text" name="street" value="{{ $address->street }}" placeholder=""></div>
                <div><h4>Altura:</h4><input type="text" name="number" value="{{ $address->number }}" placeholder=""></div>
                <div>
                    <h4>Ciudad:</h4>
                    <select name="city_id" id="">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @if($city->id == $address->city_id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><h4>Enlace de google maps:</h4><input type="text" name="link" value="{{ $address->lat }}" placeholder=""></div>
                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
@endsection