@extends('dashboard.layouts.app')

@section('styles')
<style>
    .error-message {
        color: red;
        margin: 0 1em 1em 0;
        font-weight: 500;
        text-align: right;
    }

    .error-input {
        border-color: red !important;
    }
</style>
@endsection

@section('content')
<main>
    @if (Auth::user()->district_id)
    <div class="title">
        <h2>Localidades</h2>
    </div>

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
                <div class="info-1">
                    <b>Nombre:</b> {{ $city->name }}</br>
                    <b>Descripción:</b> {{ $city->description }}
                </div>
            </div>
            <div class="icon">
                <a href="{{ url('panel-de-administracion/cities/' . $city->id . '/edit') }}" class="btn-edit"><i
                        class="icon-edit"></i></a>
            </div>
        </section>
        @endforeach
    </div>
    @endif
</main>
@endsection

@section('scripts')

<script src="{{ asset('js/contchar.js') }}"></script>

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