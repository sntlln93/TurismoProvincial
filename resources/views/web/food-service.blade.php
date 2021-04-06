@extends('layouts.app')

@section('content')
<main class="main-web">
    <div class="title-web">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>            
        <div class="title">
            <h2>
                <a class="hover__link" href="{{ url('/'.$district->slug.'/'.$food_service->type->metaType->slug) }}">
                    {{ $food_service->type->metaType->name }}
                </a> / 
                <a class="hover__link" href="{{ url('/'.$district->slug.'/categorias/'.$food_service->type->slug) }}">
                    {{ $food_service->type->name }}    
                </a> /
                {{ $food_service->name }}</h2>
        </div> 
    </div>

    <div class="info gastronomy">
        <img src="{{ findOne($food_service->id, 'App\\Models\\Service')->first() }}" alt="{{ $food_service->slug }}">
        <div class="info-icon">
            <div class="dato">
                <i class="icon-map-o"></i><h4><b>Localidad:</b> {{ $food_service->address->city->name }}</h4>
            </div>
            <div class="dato">
                <i class="icon-location"></i><h4><b>Dirección:</b> {{ $food_service->address->full_address }}</h4>
            </div>
            <div class="dato">
                <i class="icon-phone"></i><h4><b>Teléfono:</b> @foreach($food_service->phones as $phone) {{ $phone->contact }} @endforeach</h4>
            </div>
            <div class="dato">
                <i class="icon-clock"></i><h4><b>Horario de atención:</b> {{ $food_service->start->format('h:i') }} - {{ $food_service->end->format('h:i') }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-globe"></i><a href="https://www.facebook.com/pages/category/Argentinian-Restaurant/Origenes-Restaurante-y-Eventos-1604668823119933/" target="_blanck"><h4><b>Sitio web</b></h4></a>
            </div>
            <div class="dato">
                <i class="icon-pin"></i><a href="{{ $food_service->address->lat }}" target="_blanck"><h4><b>Como llegar</b></h4></a>
            </div>                    
        </div>
    </div>

    <div class="title-galery">
        <h2>Algunas fotos de sus instalaciones</h2>
    </div>
    <div class="box galery">
        @foreach(findOne($food_service->id, 'App\\Models\\Service') as $image)
            <img src="{{ $image }}" alt="{{ $food_service->slug }}">
        @endforeach
    </div>
    
</main>
@endsection