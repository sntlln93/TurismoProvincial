@extends('layouts.app')

@section('content')
    <main class="main-web">
        <div class="title-web">
            <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
            <div class="title">
                <h2>
                    <a class="hover__link"
                        href="{{ url('/' . $district->slug . '/' . $food_service->type->metaType->slug) }}">
                        {{ $food_service->type->metaType->name }}
                    </a> /
                    {{ $food_service->type->name }}
                    /
                    {{ $food_service->name }}
                </h2>
            </div>
        </div>

        <div class="info gastronomy">
            <img src="{{ findOne($food_service->id, 'App\\Models\\Service')->first() }}"
                alt="{{ $food_service->slug }}">
            <div class="info-icon">
                <div class="dato">
                    <i class="icon-map-o"></i>
                    <h4><b>Localidad:</b> {{ $food_service->address->city->name }}</h4>
                </div>
                <div class="dato">
                    <i class="icon-location"></i>
                    <h4><b>Dirección:</b> {{ $food_service->address->full_address }}</h4>
                </div>
                @if ($food_service->phones->count() > 0)
                    <div class="dato">
                        <i class="icon-phone"></i>
                        <h4><b>Teléfono:</b>
                            @foreach ($food_service->phones as $phone)
                                {{ $phone->contact }}
                            @endforeach
                        </h4>
                    </div>
                @endif
                <div class="dato">
                    <i class="icon-clock"></i>
                    <h4><b>Horario de atención:</b> {{ $food_service->start }} - {{ $food_service->end }} hs</h4>
                </div>
                @if ($food_service->website)
                    <div class="dato">
                        <i class="icon-globe"></i><a href="{{ $food_service->website }}" target="_blanck">
                            <h4><b>Sitio web</b></h4>
                        </a>
                    </div>
                @endif
                <div class="dato">
                    <i class="icon-pin"></i><a href="{{ $food_service->address->map_link }}" target="_blank">
                        <h4><b>Como llegar</b></h4>
                    </a>
                </div>
            </div>
        </div>

        <div class="title-galery">
            <h2>Algunas fotos de sus instalaciones</h2>
        </div>
        <div class="box galery">
            @foreach (findOne($food_service->id, 'App\\Models\\Service') as $image)
                <img src="{{ $image }}" alt="{{ $food_service->slug }}">
            @endforeach
        </div>

    </main>
@endsection
