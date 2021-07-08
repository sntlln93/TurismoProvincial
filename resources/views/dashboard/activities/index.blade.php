@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Experiencias</h2>
    </div>

    <div class="row">
        <div class="search">
            <input id="activity-search" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar">
            <button><i class="icon-search"></i></button>
        </div>
        <div class="add-other">
            <button id="newActivity">
                <i class="icon-plus"></i> Nueva experiencia
            </button>
        </div>
    </div>

    <div class="articles activities">
        @foreach($activities as $activity)
        <section class="article">
            <div class="article-info">
                <div class="info-1">
                    <b>Actividad:</b> {{ $activity->name }}</br>
                    <b>Responsable:</b> {{ Str::title($activity->responsable) }}</br>
                    <b>Precio:</b> ${{ $activity->amount }}
                </div>
                <div class="info-2">
                    <b>Atractivo turístico:</b> {{ $activity->location->name }}</br>
                    <b>Inicio:</b> {{ $activity->start->format('d/m/Y')}} a las
                    {{ $activity->start->format('h:i') }} hs
                    </br>
                    <b>Fin:</b> {{ $activity->end->format('d/m/Y') }} a las {{ $activity->end->format('h:i') }} hs
                </div>
                <div class="info-3">
                    <b>Descripción:</b> {{ $activity->description }}
                </div>
            </div>
            <div class="icon">
                <a href="{{ url('dashboard/photos/activities/'.$activity->id) }}" class="btn-show"><i
                        class="icon-picture"></i></a>
                <a href="{{ url('dashboard/activities/'.$activity->id.'/edit') }}" class="btn-edit"><i
                        class="icon-edit"></i></a>
                <form action="{{ url('dashboard/activities/'.$activity->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn-delete" type="submit"><i class="icon-trash-empty"></i></button>
                </form>
            </div>
        </section>
        @endforeach
    </div>
</main>
@endsection


@section('scripts')
<script>
    document.getElementById('newActivity').addEventListener('click', () => {
        window.location.href = "{{ route('activities.create') }}";
    })
</script>

<script>
    const input = document.getElementById("activity-search");

    const filter = () => {
      const params = input.value.toLowerCase();
      const activities = document.getElementsByClassName("article");
   
      Array.from(activities).forEach((activity) => {
        const text = activity.getElementsByClassName("article-info")[0];
        const name = text.children[0].innerHTML.toLowerCase();

        if(name.includes(params)) {
            activity.style.display = "flex"
        } else {
            activity.style.display = "none"
        }
      });
    }

    input.addEventListener("keyup", filter);
</script>
@endsection