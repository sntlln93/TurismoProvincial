@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Para trasladarte</h2>

    <div class="accordion articles">
        @foreach($types as $type)
        @if($type->services->count() > 0)
        <div class="accordion-item">
            <!-- Aquí va el for para recorrer los subtipos de transporte que se hayan cargado 
                    serían el titulo, como en este caso "transporte público" -->
            <div class="accordion-header">
                @if(Str::contains(Str::slug($type->name), 'publico'))
                <i class="icon-bus"></i>
                @elseif(Str::contains(Str::slug($type->name), 'taxi'))
                <i class="icon-taxi"></i>
                @elseif(Str::contains(Str::slug($type->name), 'interurbano'))
                <i class="icon-bus"></i>
                @elseif(Str::contains(Str::slug($type->name), 'larga distancia'))
                <i class="icon-bus"></i>
                @elseif(Str::contains(Str::slug($type->name), 'aeropuerto'))
                <i class="icon-flight"></i>
                @elseif(Str::contains(Str::slug($type->name), 'remis'))
                <i class="icon-taxi"></i>
                @else
                <i class="icon-info"></i>
                @endif
                {{ $type->name }}
            </div>
            <div class="accordion-body">
                @foreach($type->services as $service)
                <div class="article">
                    <img src="{{ findOne($service->id, 'App\\Models\\Service')->first() }}" alt="{{ $service->slug }}">
                    <div class="article-info">
                        <b>Nombre:</b> {{ $service->name }}</br>
                        @if($service->address)
                        <b>Localidad:</b> {{ $service->address->city->name }} </br>
                        <b>Dirección:</b> {{ $service->address->full_address }} </br>
                        @endif
                        <b>Horario de atención:</b> {{ $service->start }} hs a {{ $service->end }} hs </br>
                        @if (!is_null($food_service->phones))
                        @foreach ($food_service->phones as $phone)
                        <div class="dato">
                            <i class="icon-phone"></i>
                            <h4><b>Teléfono:</b>
                                {{ $phone->contact }}
                            </h4>
                        </div>
                        @endforeach
                        @endif
                        @if ($service->email)
                        <b>Correo electrónico:</b> {{ $service->email }} <br>
                        @endif
                        @if ($service->website)
                        <b>Sitio web:</b>
                        <a href="{{ $service->website }}" target="_blank">{{ $service->website }}</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <!-- <h2>Aplicaciones útiles</h2>
    <div class="apps">
        <a class="app" href="https://play.google.com/store/apps/details?id=ar.com.proxibus.app" target="_blank">
            <img src="../../public/img/transport/proxibus.PNG" alt="">
            <h4>Proxibus</h4>
        </a>
        <a class="app" href="https://play.google.com/store/apps/details?id=com.taxero.argentina.client" target="_blank">
            <img src="../../public/img/transport/taxero.PNG" alt="">
            <h4>Taxero</h4>
        </a>
    </div> -->
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/accordion.js') }}"></script>
@endsection