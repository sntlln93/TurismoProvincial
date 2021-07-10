@extends('dashboard.layouts.app')

@section('content')
<main>

    <div class="title">
        <h2>Servicios</h2>
    </div>
    <p class="subtitle">Verás estos cambios en
        <a href="{{ route('foodservices-page', ['district' => auth()->user()->district->slug]) }}"
            target="_blank">Gastronomía</a> -
        <a href="{{ route('lodging-page', ['district' => auth()->user()->district->slug]) }}"
            target="_blank">Alojamiento</a> -
        <a href="{{ route('transport-page', ['district' => auth()->user()->district->slug]) }}"
            target="_blank">Transporte</a>
    </p>

    <div class="row">
        <div class="add-other only-button">
            <a href="{{ url('dashboard/services/create') }}"><button id="open">
                    <i class="icon-plus"></i> Nuevo servicio
                </button></a>
        </div>

        <div class="add-other only-button">
            <a href="{{ url('dashboard/types') }}"><button id="open">
                    Ver tipos de servicios
                </button></a>
        </div>
    </div>

    <div class="accordion articles">
        @foreach ($types as $type)
        <div class="accordion-item">
            <div class="accordion-header">
                @if ($type->name == 'Alojamiento')
                <i class="icon-bed"></i>
                @elseif($type->name == "Gastronomía")
                <i class="icon-food"></i>
                @elseif($type->name == "Transporte")
                <i class="icon-bus"></i>
                @endif
                {{ $type->name }}
            </div>
            <div class="accordion-body">
                @foreach ($type->subtypes as $subtype)
                @if ($subtype->services->count() > 0) {{-- this prevents render of empty accordion-bodies --}}
                @foreach ($subtype->services as $service)
                @if (in_array($service->id, $localAddresses))
                <div class="article">
                    <div class="article-info">
                        <div class="info-1">
                            <b>Nombre:</b> {{ $service->name }}</br>
                            <b>Responsable:</b> {{ Str::title($service->responsable) }}</br>
                            @if ($service->address)
                            <b>Localidad:</b> {{ $service->address->city->name }}
                            @endif
                        </div>
                        <div class="info-2">
                            <b>{{ $type->name == 'Alojamiento' ? 'Check in:' : 'Abre a las:' }}</b>
                            {{ $service->start }} hs </br>
                            <b>{{ $type->name == 'Alojamiento' ? 'Check out:' : 'Cierra a las:' }}</b>
                            {{ $service->end }} hs </br>
                            <b>Subtipo:</b> {{ $subtype->name }}
                        </div>
                    </div>
                    <div class="icon">
                        <a href="{{ url('dashboard/services/' . $service->id) }}" class="btn-show"><i
                                class="icon-info-circled"></i></a>
                        <a href="{{ url('dashboard/services/' . $service->id . '/edit') }}" class="btn-edit"><i
                                class="icon-edit"></i></a>
                        <form action="{{ url('dashboard/services/' . $service->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-delete" type="submit"><i class="icon-trash-empty"></i></button>
                        </form>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

</main>
@endsection

@section('scripts')
<script src="{{ asset('js/accordion.js') }}"></script>
@endsection