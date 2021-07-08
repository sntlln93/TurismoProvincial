@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <div class="title">
            <h2>Imágenes de {{ $photos->first()->imageable->name }}</h2>
        </div>
    </div>

    <div class="row">
        <div class="add-other only-button">
            <a href="{{ url('dashboard/photos/'.$type.'/'.$id.'/create') }}"><button id="open">
                    <i class="icon-plus"></i> Añadir imágenes
                </button></a>

        </div>
    </div>

    @if($photos->where('is_primary')->first())
    <div class="articles district">
        <div class="article primary__image">
            <span class="primary_header">Imagen principal</span>
            <img src="{{ asset('storage/'.$photos->where('is_primary')->first()->path) }}" alt="">
        </div>
    </div>
    @endif

    <div class="articles district">
        @foreach($photos as $photo)
        <div class="article primary__image">
            <img src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->imageable->slug }}">
            <div class="icon">
                @if(! $photo->is_primary)
                <a href="{{ url('dashboard/photos/mark-as-primary/'.$photo->id) }}" class="btn-icon_text image">
                    <div>
                        <h4>Marcar como principal</h4>
                        <i class="icon-check"></i>
                    </div>
                </a>
                @endif
                <form action="{{ url('dashboard/photos/'.$photo->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn-delete image" type="submit"><i class="icon-trash-empty"></i></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</main>
@endsection