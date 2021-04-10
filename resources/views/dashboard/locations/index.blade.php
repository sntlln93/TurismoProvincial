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
        <div class="title">
            <h2>Atractivos turísticos</h2>
        </div>

        <div class="row">
            <div class="search">
                <input id="location-search" type="text" class="form-control" placeholder="Buscar" aria-label="Buscar">
                <button><i class="icon-search"></i></button>
            </div>
            <div class="add-other">
                <button id="open">
                    <i class="icon-plus"></i> Nuevo atractivo turístico
                </button>
            </div>
        </div>

        <div id="miModal" class="modal add">
            <div class="flex" id="flex">
                <div class="container-modal">
                    <div class="modal-header flex">
                        <h2>Nuevo producto turístico</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <form action="{{ url('panel-de-administracion/locations') }}" method="POST" class="modal-body"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                                value="" placeholder="">
                        </div>
                        @error('name') <small class="error-message">{{ $message }}</small> @enderror

                        <!-- for con todas las localidades que estén cargadas -->
                        @include('dashboard._partials.create-address')
                        <div>
                            <h4>Apertura:</h4><input class="@error('start') error-input @enderror" type="time" name="start"
                                value="">
                        </div>
                        @error('start') <small class="error-message">{{ $message }}</small> @enderror

                        <div>
                            <h4>Cierre:</h4><input class="@error('end') error-input @enderror" type="time" name="end"
                                value="">
                        </div>
                        @error('end') <small class="error-message">{{ $message }}</small> @enderror

                        <div>
                            <h4>Fotos:</h4><input class="@error('photos') error-input @enderror" type="file" name="photos[]"
                                accept="image/png, .jpeg, .jpg" multiple>
                        </div>
                        @error('photos') <small class="error-message">{{ $message }}</small> @enderror

                        <div>
                            <h4>Descripción:</h4>
                            <textarea name="description" class="@error('description') error-input @enderror msj" rows="6"
                                maxlength="1000" placeholder="Escribe aquí la descripción"></textarea>

                        </div>
                        @error('description') <small class="error-message">{{ $message }}</small> @enderror
                        <label class="cont">Cantidad de carácteres: 0/1000</label>

                        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
                    </form>
                </div>
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
                                <a href="{{ url('panel-de-administracion/photos/locations/' . $location->id) }}"
                                    class="btn-show"><i class="icon-picture"></i></a>
                            @else
                                <a href="{{ route('photo.create', ['type' => 'locations', 'id' => $location->id]) }}"
                                    class="btn-show"><i class="icon-picture"></i></a>
                            @endif
                            <a href="{{ url('panel-de-administracion/locations/' . $location->id . '/edit') }}"
                                class="btn-edit"><i class="icon-edit"></i></a>
                            <form action="{{ url('panel-de-administracion/locations/' . $location->id) }}" method="POST">
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
    <script src="{{ asset('js/modal.js') }}"></script>

    @if ($errors->any())
        <script>
            const createForm = document.getElementById("miModal");
            createForm.style.display = "block";

        </script>
    @endif
    <script src="{{ asset('js/contchar.js') }}"></script>

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
