@extends('layouts.app')

@section('content')
<div class="slider" id="slider-container">
    <div class="slider-images" id="slider-js"></div>
    
    <div class="slider-navigation" id="slider-navigation"></div>
</div> 

<main class="main-web about">
    <h3>Intendente {{ $district->mayor }}</h3>
    <h1>Departamento {{ $district->name }}</h1></br>
    <p>{{ $district->description }}</p>
</main>

<div class="container-btn-top">
    <div class="btn-top">
        <i class="icon-angle-up"></i>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/carrusel.js') }}"></script>
    <script>
        const images = [];
        
        @forelse($district->images as $image)
            images.push("{!! $image !!}");
        @empty
            images.push("img/no-image.png");
        @endforelse
        
        
        carrusel(images, "{!! env('APP_URL') !!}");
    </script>
    <script src="{{ asset('js/buttonUp.js') }}"></script>    
@endsection