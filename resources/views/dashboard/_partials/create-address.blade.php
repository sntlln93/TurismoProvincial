<div><h4>Calle:</h4><input class="@error('street') error-input @enderror" type="text" name="street" value="" placeholder=""></div>
@error('street') <small class="error-message">{{ $message }}</small> @enderror

<div><h4>Altura:</h4><input class="@error('number') error-input @enderror" type="number" name="number" value="" placeholder=""></div>
@error('number') <small class="error-message">{{ $message }}</small> @enderror

<!-- for con todas las localidades que estén cargadas -->
<div><h4>Localidad:</h4>
    <select name="city_id" class="@error('city_id') error-input @enderror" type="text">
        @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>  
</div>
@error('city_id') <small class="error-message">{{ $message }}</small> @enderror

<div><h4>Enlace de google maps:</h4><input class="@error('map_link') error-input @enderror" type="text" name="map_link" value="" placeholder=""></div>
@error('map_link') <small class="error-message">{{ $message }}</small> @enderror