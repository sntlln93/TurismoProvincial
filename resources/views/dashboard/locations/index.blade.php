@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Atractivos turísticos</h2>
    </div>

    <div class="row">
        <div class="search">
            <input id="location-search" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar">
            <button><i class="icon-search"></i></button>
        </div>
        <div class="add-other">
            <button id="newLocation">
                <i class="icon-plus"></i> Nuevo atractivo turístico
            </button>
        </div>
    </div>

    <div class="articles places">
        @foreach ($locations as $address)
        @php($location = $address->addressable)
        <section class="article">
            <div class="article-info">
                <div class="info-1">
                    <b>Nombre:</b> {{ $location->name }} </br>
                    <b>Localidad:</b> {{ $address->city->name }} </br>
                    <b>Abre a las:</b> {{ $location->start->format('h:i') }} </br>
                    <b>Cierra a las:</b> {{ $location->end->format('h:i') }}
                </div>
                <div class="info-2">
                    <b>Creado:</b> {{ $location->created_at->diffForHumans() }} </br>
                    <b>Modificado:</b> {{ $location->updated_at->diffForHumans() }}
                </div>
                <div class="info-3">
                    <b>Descripción:</b> {{ $location->description }}
                </div>
            </div>
            <div class="icon">
                @if ($location->images->count() > 0)
                <a href="{{ url('dashboard/photos/locations/' . $location->id) }}" class="btn-show"><i
                        class="icon-picture"></i></a>
                @else
                <a href="{{ route('photo.create', ['type' => 'locations', 'id' => $location->id]) }}"
                    class="btn-show"><i class="icon-picture"></i></a>
                @endif
                <a href="{{ url('dashboard/locations/' . $location->id . '/edit') }}" class="btn-edit"><i
                        class="icon-edit"></i></a>
                <form action="{{ url('dashboard/locations/' . $location->id) }}" method="POST">
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
    document.getElementById('newLocation').addEventListener('click', () => {
        window.location.href = "{{ route('locations.create') }}";
    })
</script>

<script>
    const input = document.getElementById("location-search");

        const filter = () => {
            const params = input.value.toLowerCase();
            const locations = document.getElementsByClassName("article");

            Array.from(locations).forEach((location) => {
                const text = location.getElementsByClassName("article-info")[0];
                const name = text.children[0].innerHTML.toLowerCase();

                if (name.includes(params)) {
                    location.style.display = "flex"
                } else {
                    location.style.display = "none"
                }
            });
        }

        input.addEventListener("keyup", filter);

</script>
@endsection