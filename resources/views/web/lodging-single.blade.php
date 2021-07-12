@extends('layouts.app')

@section('content')
<main class="main-web">

    <div class="title-web">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <div class="title">
            <h2>
                <a class="hover__link" href="{{ url('/' . $district->slug . '/' . $lodging->type->metaType->slug) }}">
                    {{ $lodging->type->metaType->name }}
                </a> /
                {{ $lodging->type->name }}
                /
                {{ $lodging->name }}
            </h2>
        </div>
    </div>

    <div class="info accommodation">
        <img src="{{ findOne($lodging->id, 'App\\Models\\Service')->first() }}" alt="{{ $lodging->slug }}">
        <div class="info-icon">
            <div class="dato">
                <i class="icon-map-o"></i>
                <h4><b>Localidad:</b> {{ $lodging->address->city->name }}</h4>
            </div>
            <div class="dato">
                <i class="icon-location"></i>
                <h4><b>Dirección:</b> {{ $lodging->address->full_address }}</h4>
            </div>
            @if (!is_null($lodging->phones))
            <div class="dato">
                <i class="icon-phone"></i>
                <h4><b>Teléfono:</b>
                    @foreach ($lodging->phones as $phone)
                    {{ $phone->contact }} @if(!$loop->last) | @endif
                    @endforeach
                </h4>
            </div>
            @endif
            <div class="dato">
                <i class="icon-clock"></i>
                <h4><b>Check in:</b> {{ $lodging->start }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-clock"></i>
                <h4><b>Check out:</b> {{ $lodging->end }} hs</h4>
            </div>
            <div class="dato">
                <i class="icon-globe"></i><a href="{{ $lodging->website }}" target="_blank">
                    <h4><b>Sitio web</b></h4>
                </a>
            </div>
            @if ($lodging->email)
            <div class="dato">
                <i class="icon-mail-alt"></i>
                <h4><b>Correo electrónico:</b> {{ $lodging->email }}</h4>
            </div>
            @endif
            @if ($lodging->address->indications)
            <div class="dato">
                <i class="icon-clock"></i>
                <h4><b>Referencias:</b> {{ $lodging->address->indications }}</h4>
            </div>
            @endif
            @if ($lodging->address->map_link)
            <div class="dato">
                <i class="icon-pin"></i><a href="{{ $lodging->address->map_link }}" target="_blank">
                    <h4><b>Como llegar</b></h4>
                </a>
            </div>
            @endif
        </div>
    </div>

    <div class="title-galery">
        <h2>Algunas fotos de sus instalaciones</h2>
    </div>
    <div class="box galery">
        @foreach ($lodging->images as $image)
        <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $lodging->slug }}">
        @endforeach
    </div>

</main>
@endsection