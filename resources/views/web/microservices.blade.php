@extends('layouts.app')

@section('styles')
<style>
    /* Always set the map height explicitly to define the size of the div
* element that contains the map. */
    #map {
        height: 75vh;
    }
</style>
@endsection

@section('content')
<main class="main-web about">
    <div class="title-web">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <div class="title">
            <h2>
                Cerca tuyo
            </h2>
        </div>
    </div>
    <div id="map"></div>
</main>
@endsection

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&libraries=places&callback=initMap" async>
</script>
<script>
    var map;
    let mapContainer = document.getElementById("map");
    

    initMap = () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const userLocation = {
                    lat: position.coords.latitude, 
                    lng: position.coords.longitude
                };
                
                let options = {
                    zoom: 16,
                    center: userLocation,
                    disableDefaultUI: true,
                    styles: [{
                        "featureType": "poi",
                        "stylers": [{
                        }]
                    }]
                }

                //initialize a map
                map = new google.maps.Map(mapContainer, options);
            }, 
            (error) => {
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        mapContainer.innerHTML = "Para poder ver el mapa necesitas compartir tu ubicación."
                    break;
                }
            });
        } else {
            mapContainer.innerHTML = "Servicios de geolocalización no soportados por tu navegador";
        }
    }
</script>
@endsection