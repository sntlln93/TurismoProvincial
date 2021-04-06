@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Dónde comer</h2>
    <div class="box-flex">
        @foreach($food_services as $food)
            <a class="card-info" href="{{ url($district->slug.'/gastronomia/'.$food->slug) }}">
                <img src="{{ findOne($food->id, 'App\\Models\\Service')->first() }}" alt="">
                <div class="info-contact">
                    <h3>{{ $food->name }}</h3>
                    <small>{{ $food->type->name }}</small>
                    <ul>
                        @if($food->address->lat)
                            <li><i class="icon-location"></i>A 3 cuadras de vos</li>
                        @endif
                        @if($food->phones->count() > 0)
                            <li><i class="icon-phone"></i>{{ $food->phones->first()->contact }}</li>
                        @endif
                        <li><i class="icon-clock"></i>{{ $food->start }} - {{ $food->end }}</li>
                    </ul>
                </div>
            </a>
        @endforeach
    </div>
</main>
@endsection