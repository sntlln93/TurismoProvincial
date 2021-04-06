@extends('dashboard.layouts.app')

@section('content')
    <main>

        <div class="title">
            <h2>Servicios</h2>
        </div>

        <div class="row">
            <!-- <div class="search">
                        <select name="services">
                            <option>Seleccionar una opción</option>
                            <optgroup label="Alojamiento">
                                <option>Hotel</option>
                                <option>Hostel</option>
                                <option>Cabaña</option>
                            </optgroup>
                            <optgroup label="Gastronomía">
                                <option>Restaurante</option>
                                <option>Bar</option>
                                <option>Cafetería</option>
                            </optgroup>
                            <optgroup label="Transporte">
                                <option>Transporte Público</option>
                                <option>Taxis y Remises</option>
                                <option>Terminal de Omnibus</option>
                                <option>Aeropuerto</option>
                            </optgroup>
                        </select>
                    </div> -->
            <div class="add-other only-button">
                <a href="{{ url('panel-de-administracion/services/create') }}"><button id="open">
                        <i class="icon-plus"></i> Nuevo servicio
                    </button></a>
            </div>

            <div class="add-other only-button">
                <a href="{{ url('panel-de-administracion/types') }}"><button id="open">
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
                        @else
                            <i class="icon-cog"></i>
                        @endif
                        {{ $type->name }}
                    </div>
                    @foreach ($type->subtypes as $subtype)
                        @if ($subtype->services->count() > 0) {{-- this prevents render of empty accordion-bodies --}}
                            <div class="accordion-body">
                                @foreach ($subtype->services as $service)
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
                                            <a href="{{ url('panel-de-administracion/services/' . $service->id) }}"
                                                class="btn-show"><i class="icon-info-circled"></i></a>
                                            <a href="{{ url('panel-de-administracion/services/' . $service->id . '/edit') }}"
                                                class="btn-edit"><i class="icon-edit"></i></a>
                                            <form action="{{ url('panel-de-administracion/services/' . $service->id) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button class="btn-delete" type="submit"><i
                                                        class="icon-trash-empty"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/accordion.js') }}"></script>
@endsection
