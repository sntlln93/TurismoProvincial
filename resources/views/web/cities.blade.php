@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Localidades del Departamento</h2>
    
    <div class="box-flex district">
        @foreach($cities as $city)
            <a class="card-flex-district" href="{{ url($district->slug.'/localidades/'.$city->slug) }}">
                <img src="{{ findAll($city->locations->random()->id, 'App\\Models\\Location')->first() }}" alt="{{ $city->slug }}">
                <h3>{{ $city->name }}</h3>
            </a>
        @endforeach
    </div>
</main>
@endsection