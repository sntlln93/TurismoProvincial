@extends('layouts.app')

@section('title')
{{ $district->name }}
@endsection

@section('content')
<div class="slider" id="slider-container">
    <div class="slider-images" id="slider-js"></div>

    <div class="slider-navigation" id="slider-navigation"></div>
</div>

<main class="main-web">
    <div class="box-scroll">

        <!-- Actividades -->
        @if ($district->activities->count() > 0)
        <h2>Experiencias</h2>
        <div class="box-activities">
            @foreach($district->activities as $activity)
            <div class="card-activities">
                <img src="{{ findOne($activity->id, 'App\Models\Activity')->first() }}" alt="{{ $activity->slug }}">
                <div class="info">
                    <h3>{{ $activity->name }}</h3>
                    <p>{{ Str::limit($activity->description, 175, '...') }}</p>
                    <a href="{{ url($district->slug.'/experiencias/'.$activity->slug) }}" class="btn">Leer más</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Alojamiento -->
        @if($district->lodging->count() > 0)
        <h2>Alojamiento</h2>
        <div class="box">
            @foreach($district->lodging as $lodge)
            <a class="card-accommodations" href="{{ url($district->slug.'/alojamiento/'.$lodge->slug) }}">
                <img src="{{ findOne($lodge->id, 'App\\Models\\Service')->first() }}" alt="{{ $lodge->slug }}">
                <h5>{{ $lodge->name }} </h5>
            </a>
            @endforeach
        </div>
        @endif

        <!-- Gastronomía -->
        @if($district->food->count() > 0)
        <h2>Gastronomía</h2>
        <div class="box">
            @foreach ($district->food as $food_service)
            <a class="card-gastronomy" href="{{ url($district->slug.'/gastronomia/'.$food_service->slug) }}">
                <img src="{{ findOne($food_service->id, 'App\\Models\\Service')->first() }}"
                    alt="{{ $food_service->slug }}">
                <h5>{{ $food_service->name }}</h5>
            </a>
            @endforeach
        </div>
        @endif

        <!-- Microservicios -->
        <h2>Encontrar más servicios</h2>
        <div class="box">
            <div class="card-microservices">
                <a href="{{ route('microservices', ['district' => $district->slug]) }}">
                    <i class="icon-map-o"></i>
                    <h5>Ver mapa</h5>
                </a>
            </div>

            <div class="card-microservices">
                <a href="{{ route('transport-page', ['district' => $district->slug]) }}">
                    <i class="icon-bus"></i>
                    <h5>Transporte</h5>
                </a>
            </div>
        </div>
    </div>

    <div class="container-btn-top">
        <div class="btn-top">
            <i class="icon-angle-up"></i>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script src="{{ asset('js/slider.js') }}"></script>
<script>
    const images = [];
        
        @forelse($district->images as $image)
            images.push("{!! $image !!}");
        @empty
            images.push("img/no-image.png");
        @endforelse
        
        slider(images, "{!! env('APP_URL') !!}");
</script>
<script src="{{ asset('js/buttonUp.js') }}"></script>

@endsection