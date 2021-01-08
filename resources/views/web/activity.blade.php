@extends('layouts.app')

@section('content')
<main class="main-web">
    <div class="title-web">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>            
        <div class="title">
            <h2>
                <a href="{{ url($district->slug.'/experiencias') }}" class="hover__link">
                    Experiencias
                </a> / 
                {{ $activity->name }}
            </h2>
        </div> 
    </div>

    <div class="info activity">
        <img src="{{ findOne($activity->id, 'App\\Activity')->first() }}" alt="{{ $activity->slug }}">
        <div class="info-icon">
            <div class="dato">
                <i class="icon-clock"></i><h4><b>Horario:</b> {{ $activity->start->format('h:i') }} hs - {{ $activity->end->format('h:i') }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-location"></i><h4><b>Lugar:</b> {{ $activity->location->name }}</h4>
            </div>
            <div class="dato">
                <i class="icon-dollar"></i><h4><b>Precio:</b> {{ $activity->amount > 0 ? '$'.$activity->amount.' (ARS)' : 'GRATIS' }}</h4>
            </div>
            @if($activity->location_id)
                <div class="dato">
                    <i class="icon-pin"></i><a target="_blank" href="{{ 'https://www.google.com.ar/maps/place/'.$activity->location->name.','.$activity->location->city->name.'/' }}" target="_blanck"><h4><b>Como llegar</b></h4></a>
                </div>                    
            @endif
        </div>
    </div>

    <div class="description activity">
        <h2>Descripción:</h2>
        <p>
            {{ $activity->description }}
        </p>
    </div>
    
</main>
@endsection