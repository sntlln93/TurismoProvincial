@extends('dashboard.layouts.app')

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
                    <button id="open">
                        <i class="icon-plus"></i> Nueva localidad
                    </button>
                </div>
            </div>


            <div id="miModal" class="modal add">
                <div class="flex" id="flex">
                    <div class="container-modal">
                        <div class="modal-header flex">
                            <h2>Nueva localidad</h2>
                            <span class="close" id="close">&times;</span>
                        </div>
                        <div>
                            <form action="{{ url('panel-de-administracion/cities') }}" method="POST" class="modal-body"
                                enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text"
                                        name="name" value="" placeholder="Nombre de la localidad">
                                </div>
                                @error('name') <small class="error-message">{{ $message }}</small> @enderror

                                <div>
                                    <h4>Foto:</h4><input class="@error('photo') error-input @enderror" type="file"
                                        name="photo" accept="image/png, .jpeg, .jpg" multiple>
                                </div>
                                @error('photo') <small class="error-message">{{ $message }}</small> @enderror

                                <div>
                                    <h4>Descripción:</h4>
                                    <textarea class="@error('description') error-input @enderror msj" name="description"
                                        maxlength="1000" rows="5"
                                        placeholder="Escribí una descripción de la localidad"></textarea>
                                </div>
                                @error('description') <small class="error-message">{{ $message }}</small> @enderror

                                <label class="cont">Cantidad de carácteres: 0/1000</label>
                                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="articles">
                @foreach ($district->cities as $city)
                    <section class="article d-flex">
                        <div class="article-info">
                            <div class="info-1 image">
                                @if ($city->image)
                                    <img id="city-image" src="{{ asset('storage/' . $city->image->path) }}"
                                        alt="{{ $city->name }}">
                                @endif
                            </div>
                            <div class="info-2">
                                <b>Nombre:</b> {{ $city->name }}</br>
                                <b>Descripción:</b> {{ $city->description }}
                            </div>
                        </div>
                        <div class="icon">
                            <a href="{{ url('panel-de-administracion/cities/' . $city->id . '/edit') }}"
                                class="btn-edit"><i class="icon-edit"></i></a>
                        </div>
                    </section>
                @endforeach
            </div>
        @endif
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
@endsection
