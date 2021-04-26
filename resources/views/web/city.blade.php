@extends('layouts.app')

@section('content')
    <main class="main-web">

        <div class="title-web">
            <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
            <div class="title">
                <h2><a class="hover__link" href="{{ url($district->slug . '/localidades') }}">Localidades</a> /
                    {{ $city->name }}
                </h2>
            </div>
        </div>

        <div class="info">
            <img src="{{ asset('storage/' . $city->image->path) }}" alt="{{ $city->slug }}">
        </div>
        <div class="description">
            <h2>Descripción:</h2>
            <p>{{ $city->description }}</p>
        </div>
    </main>
@endsection
