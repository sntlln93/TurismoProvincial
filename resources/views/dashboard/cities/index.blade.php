@extends('dashboard.layouts.app')

@section('content')
<main>
    @if (Auth::user()->district_id)
    <div class="title">
        <h2>Localidades</h2>
    </div>
    <p class="subtitle">Verás estos cambios en 
        <a href="#" target="_blank">Localidades</a>
    </p>

    <div class="row">
        <div class="search">
            <input id="city-search" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar">
            <button><i class="icon-search"></i></button>
        </div>
        <div class="add-other">
            <button id="newCity">
                <i class="icon-plus"></i> Nueva localidad
            </button>
        </div>
    </div>

    <div class="articles">
        @foreach ($district->cities as $city)
        <section class="article d-flex">
            <div class="article-info">
                <div class="info-1 image">
                    @if ($city->image)
                    <img id="city-image" src="{{ asset('storage/' . $city->image->path) }}" alt="{{ $city->name }}">
                    @endif
                </div>
                <div class="info-2">
                    <b>Nombre:</b> {{ $city->name }}</br>
                    <b>Descripción:</b> {{ $city->description }}
                </div>
            </div>
            <div class="icon">
                <a href="{{ url('dashboard/cities/' . $city->id . '/edit') }}" class="btn-edit"><i
                        class="icon-edit"></i></a>
            </div>
        </section>
        @endforeach
    </div>
    @endif
</main>
@endsection

@section('scripts')

<script>
    const input = document.getElementById("city-search");

        const filter = () => {
            const params = input.value.toLowerCase();
            const cities = document.getElementsByClassName("article");

            Array.from(cities).forEach((city) => {
                const text = city.getElementsByClassName("article-info")[0];
                const name = text.children[0].innerHTML.toLowerCase();

                if (name.includes(params)) {
                    city.style.display = "flex"
                } else {
                    city.style.display = "none"
                }
            });
        }

        input.addEventListener("keyup", filter);

</script>

<script>
    document.getElementById('newCity').addEventListener('click', () => {
        window.location.href = "{{ route('cities.create') }}";
    })
</script>
@endsection