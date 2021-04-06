@extends('layouts.app')

@section('content')
<main class="main-web">
    <h2>Experiencias</h2>
    @foreach($activities as $activity)
        <div class="box-flex activities">
            <a class="card-flex-activities" href="{{ url($district->slug.'/experiencias/'.$activity->slug) }}">
                <img src="{{ findOne($activity->id, 'App\\Models\\Activity')->first() }}" alt="{{ $activity->slug }}">
                <h3>{{ $activity->name }}</h3>
                <h5>{{ $activity->start->diffForHumans() }}</h5>
            </a>
        </div>
    @endforeach
</main>
@endsection