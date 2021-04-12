@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Localidades del Departamento {{ $district->name }}</h2>
    
    <div class="box-flex district">
        @foreach($cities as $city)
            <a class="card-flex-district" href="{{ url($district->slug.'/localidades/'.$city->slug) }}">
                <img src="{{ $city->images->count() > 0 ? asset('storage/'.$city->images->random()->path) : asset('img/no-image.png') }}" alt="{{ $city->slug }}">
                <h3>{{ $city->name }}</h3>
            </a>
        @endforeach
    </div>
</main>
@endsection