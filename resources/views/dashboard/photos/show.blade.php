@extends('dashboard.layouts.app')

@section('styles')
<style>
    .article.image__container {
        display: flex;
        background: red;
        flex-direction: column !important;
    }

    .image__img {
        width: 100%;
        margin-bottom: 1em;
    }

    .article.primary__image {
        width: 100%;
        display: flex;
        flex-direction: column !important;
    }

    .article.primary__image img {
        margin-top: 1em;
        width: 100%;
    }

    .article.primary_image .primary_header {
        font-weight: normal;
    }
</style>
@endsection

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
            <a href="{{ url('panel-de-administracion/photos/'.$type.'/'.$id.'/create') }}"><button id="open">
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
        <div class="article image__container">
            <img class="image__img" src="{{ asset('storage/'.$photo->path) }}" alt="{{ $photo->imageable->slug }}">
            <div class="icon">
                @if(! $photo->is_primary)
                <a href="{{ url('panel-de-administracion/photos/mark-as-primary/'.$photo->id) }}" class="btn-show"><i
                        class="icon-check"></i></a>
                @endif
                <form action="{{ url('panel-de-administracion/photos/'.$photo->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn-delete" type="submit"><i class="icon-trash-empty"></i></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</main>
@endsection

@section('scripts')

<script>
    const filter = () => {
      const params = input.value.toLowerCase();
      const locations = document.getElementsByClassName("article");
   
      Array.from(locations).forEach((location) => {
        const text = location.getElementsByClassName("article-info")[0];
        const name = text.children[0].innerHTML.toLowerCase();

        if(name.includes(params)) {
            location.style.display = "flex"
        } else {
            location.style.display = "none"
        }
      });
    }
</script>
@endsection