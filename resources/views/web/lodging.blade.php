@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Dónde alojarte</h2>
    <div class="box-flex">
        @foreach($lodging as $lodge)
            <a class="card-info" href="{{ url($district->slug.'/alojamiento/'.$lodge->slug) }}">
                <img src="{{ findOne($lodge->id, 'App\\Service')->first() }}" alt="{{ $lodge->slug }}">
                <div class="info-contact">
                    <h3>{{ $lodge->name }}</h3>
                    <ul>
                        <li><i class="icon-location"></i>{{ Str::title($lodge->address->street) }}</li>
                        @if($lodge->phones->count())
                            <li><i class="icon-phone"></i>{{ $lodge->phones->first()->contact }}</li>
                        @endif
                        <li><i class="icon-clock"></i>{{ $lodge->start->format('h:i') }} - {{ $lodge->end->format('h:i') }}</li>
                    </ul>
                </div>
            </a>
        @endforeach
    </div>
</main>
@endsection