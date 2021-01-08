@extends('layouts.app')

@section('content')
<main class="main-web">
    <div class="title-web">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a> 
        <div class="title">
            <h2><a href="{{ url($district->slug.'/lugares') }}" class="hover__link">Atractivos turísticos</a> / 
                {{ $location->name }}
            </h2>
        </div> 
    </div>

    <div class="info place">
        <img src="{{ findOne($location->id, 'App\\Location')->first() }}" alt="{{ $location->slug }}">
        <div class="info-icon">
            <div class="dato">
                <i class="icon-map-o"></i><h4><b>Localidad:</b> {{ $location->address->city->name }}</h4>
            </div>
            <div class="dato">
                <i class="icon-clock"></i><h4><b>Horario:</b> {{ $location->start->format('h:i') }} hs - {{ $location->end->format('h:i') }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-pin"></i><a href="{{ 'https://www.google.com.ar/maps/place/'.$location->name.','.$location->city->name.'/' }}" target="_blanck"><h4><b>Cómo llegar: </b> {{ $location->address->full_address }}</h4></a>
            </div>                    
        </div>
    </div>

    <div class="description place">
        <h2>Descripción:</h2>
        <p>{{ $location->description }}</p>
    </div>

    <div class="title-galery">
        <h2>Algunas fotos</h2>
    </div>
    <div class="box galery">
        @foreach($location->images as $image)
            <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $location->slug }}">
        @endforeach
    </div>
    
</main>
@endsection