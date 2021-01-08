@extends('layouts.app')

@section('content')
<main class="main-web">

    <div class="title-web">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>            
        <div class="title">
            <h2>
                <a class="hover__link" href="{{ url('/'.$district->slug.'/'.$lodging->type->metaType->slug) }}">
                    {{ $lodging->type->metaType->name }}
                </a> / 
                <a class="hover__link" href="{{ url('/'.$district->slug.'/categorias/'.$lodging->type->slug) }}">
                    {{ $lodging->type->name }}    
                </a> /
                {{ $lodging->name }}</h2>
        </div> 
    </div>

    <div class="info accommodation">
        <img src="{{ findOne($lodging->id, 'App\\Service')->first() }}" alt="{{ $lodging->slug }}">
        <div class="info-icon">
            <div class="dato">
                <i class="icon-map-o"></i><h4><b>Localidad:</b> {{ $lodging->address->city->name }}</h4>
            </div>
            <div class="dato">
                <i class="icon-location"></i><h4><b>Dirección:</b> {{ $lodging->address->full_address }}</h4>
            </div>
            <div class="dato">
                <i class="icon-phone"></i><h4><b>Teléfono:</b> @foreach($lodging->phones as $phone) {{ $phone->contact }} @endforeach</h4>
            </div>
            <div class="dato">
                <i class="icon-clock"></i><h4><b>Check in:</b> {{ $lodging->start->format('h:i') }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-clock"></i><h4><b>Check out:</b> {{ $lodging->end->format('h:i') }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-globe"></i><h4><b>Sitio web:</b><a href="http://www.naindoparkhotel.com/" target="_blank"> {{ $lodging->website }}</a></h4>
            </div>
            <div class="dato">
                <i class="icon-clock"></i><h4><b>Referencias:</b> {{ $lodging->address->indications }}</h4>
            </div>                    
            <div class="dato">
                <i class="icon-pin"></i><a href="https://goo.gl/maps/q9g4nfPFiouW7iQB8" target="_blanck"><h4><b>Como llegar</b></h4></a>
            </div>
        </div>
    </div>

    <div class="title-galery">
        <h2>Algunas fotos de sus instalaciones</h2>
    </div>
    <div class="box galery">
        @foreach(findOne($lodging->id, 'App\\Service') as $image)
            <img src="{{ $image }}" alt="{{ $lodging->slug }}">
        @endforeach
    </div>
    
</main>
@endsection