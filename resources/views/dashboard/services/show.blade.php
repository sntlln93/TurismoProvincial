@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <div class="title">
            <h2><a href="{{ url('dashboard/services') }}">Servicios</a> / {{ $service->name }}</h2>
        </div>
    </div>

    <div class="accordion articles">
        <div class="accordion-item">
            <div class="accordion-header"> Información de {{ $service->name }} </div>
            <div class="accordion-body">
                <div class="article">
                    <div class="article-info">
                        <div class="info-1">
                            <b>Nombre:</b> {{ $service->name }}</br>
                            <b>Responsable:</b> {{ Str::title($service->responsable) }}</br>
                            <b>Subtipo:</b> {{ $service->type->name }}
                        </div>
                        <div class="info-2">
                            <b>{{ $service->type->name == "Alojamiento" ? "Check in:" : "Abre a las:"}}</b>
                            {{ $service->start }} hs </br>
                            <b>{{ $service->type->name == "Alojamiento" ? "Check out:" : "Cierra a las:"}}</b>
                            {{ $service->end }} hs </br>
                        </div>
                    </div>
                    <div class="icon">
                        <a href="{{ url('dashboard/services/'.$service->id.'/edit') }}"" class=" btn-edit"><i
                                class="icon-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion articles">
        <div class="accordion-item">
            <div class="accordion-header"> Dirección </div>
            <div class="accordion-body">
                <div class="article">
                    <div class="article-info">
                        <div class="info-1">
                            <b>Calle:</b> {{ $service->address->street }}</br>
                            <b>Altura:</b> {{ $service->address->number ? $service->address->number : "S/N" }}</br>
                            <b>Localidad:</b> {{ $service->address->city->name }}
                        </div>
                    </div>
                    <div class="icon">
                        <a href="{{ url('dashboard/addresses/'.$service->address->id.'/edit') }}"" class=" btn-edit"><i
                                class="icon-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion articles">
        <div class="accordion-item">
            <div class="accordion-header"> Contacto <a
                    href="{{ url('dashboard/contacts/services/'.$service->id.'/create') }}"><small
                        class="hover__link">Añadir contacto</small> </a></div>
            <div class="accordion-body">
                @foreach($service->contacts as $contact)
                <div class="article">
                    <div class="article-info">
                        <div class="info-1">
                            <b>Contacto:</b> {{ $contact->contact }}</br>
                            <b>Tipo:</b> {{ $contact->type }}</br>
                        </div>
                    </div>
                    <div class="icon">
                        <a href="{{ url('dashboard/contacts/'.$contact->id.'/edit') }}"" class=" btn-edit"><i
                                class="icon-edit"></i></a>
                        <form action="{{ url('dashboard/contacts/'.$contact->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-delete" type="submit"><i class="icon-trash-empty"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="accordion articles">
        <div class="accordion-item">
            <div class="accordion-header"> Fotos <a
                    href="{{ url('dashboard/photos/services/'.$service->id.'/create') }}"><small
                        class="hover__link">Añadir fotos</small> </a></div>
            <div class="accordion-body">
                @foreach($service->images as $image)
                <div class="article">
                    <div class="article-info">
                        <img style="height: 200px; width: auto; border-radius: 5px;"
                            src="{{ asset('storage/'.$image->path) }}" alt="{{ $service->name }}">
                    </div>
                    <div class="icon">
                        @if(! $image->is_primary)
                        <a href="{{ url('dashboard/photos/mark-as-primary/'.$image->id) }}" class="btn-icon_text image">
                            <div>
                                <h4>Marcar como principal</h4>
                                <i class="icon-check"></i>
                            </div>
                        </a>
                        @endif
                        <form action="{{ url('dashboard/photos/'.$image->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-delete image" type="submit"><i class="icon-trash-empty"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script src="{{ asset('js/accordion.js') }}"></script>
@endsection