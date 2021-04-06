@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Atractivos para visitar</h2>
    <div class="box-flex">
        @foreach($locations as $location)
            <div class="card-places">
                <img src="{{ findOne($location->id, 'App\\Models\\Location')->first() }}" alt="{{ $location->slug }}">
                <h3>{{ $location->name }}</h3>
                <div class="info">
                    <p>{{ $location->description }}</p>
                    <a href="{{ url($district->slug.'/lugares/'.$location->slug) }}" class="btn">ver más</a>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection