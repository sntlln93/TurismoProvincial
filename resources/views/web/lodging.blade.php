@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Dónde alojarte</h2>
    <div class="box-flex">
        @foreach($lodging as $lodge)
            <a class="card-info" href="{{ url($district->slug.'/alojamiento/'.$lodge->slug) }}">
                <img src="{{ findOne($lodge->id, 'App\\Models\\Service')->first() }}" alt="{{ $lodge->slug }}">
                <div class="info-contact">
                    <h3>{{ $lodge->name }}</h3>
                    <small>{{ $lodge->type->name }}</small>
                    <ul>
                        <li><i class="icon-location"></i>{{ Str::title($lodge->address->full_address) }}</li>
                        @if(!is_null($lodge->phones))
                            <li><i class="icon-phone"></i>                            380 154 457895
                            </li>
                        @endif
                        <li><i class="icon-clock"></i>{{ $lodge->start }} - {{ $lodge->end }}</li>
                    </ul>
                </div>
            </a>
        @endforeach
    </div>
</main>
@endsection