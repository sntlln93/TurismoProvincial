@extends('dashboard.layouts.app')

@section('content')
    <main>
            <div class="title">
                <h2>Microservicios</h2>
            </div>
            <div class="row">
                <div class="add-other only-button">
                    <a href="{{ url('panel-de-administracion/microservices/create') }}"><button id="open">
                            <i class="icon-plus"></i> Nuevo microservicio
                        </button></a>
                </div>
            </div>

            <div id="miModal" class="modal add">
                <div class="flex" id="flex">
                    <div class="container-modal">}
                        <div class="modal-header flex">
                            <h2>Nuevo microservicio</h2>
                            <span class="close" id="close">&times;</span>
                        </div>
                        <div class="modal-body newservice">
                            <form action="{{ url('panel-de-administracion/microservices') }}" method="POST" class="modal-body" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <h4>Tipo:</h4>
                                    <select class="@error('type_id') error-input @enderror" name="type_id">
                                        @foreach($types as $type)
                                            <optgroup label="{{ $type->name }}">
                                                @foreach($type->subtypes as $subtype)
                                                    <option value="{{ $subtype->id }}">{{ $subtype->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                @error('type_id') <small class="error-message">{{ $message }}</small> @enderror

                                <div><h4>Enlace de google maps:</h4><input class="@error('map_link') error-input @enderror" type="text" name="map_link" value="" placeholder=""></div>
                                @error('map_link') <small class="error-message">{{ $message }}</small> @enderror

                                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="articles">
                @foreach ($type->subtypes as $subtype)
                    @foreach ($subtype->services as $service)
                        @if (in_array($service->id, $localAddresses))
                            <section class="article d-flex">
                                <div class="article-info">
                                    <div class="info-1">
                                        <b>Subtipo:</b> {{ $subtype->name }}
                                    </div>
                                </div>
                                <div class="icon">
                                    <a href="{{ url('panel-de-administracion/microservices/' . $service->id . '/edit') }}"
                                        class="btn-edit"><i class="icon-edit"></i></a>
                                </div>
                            </section>
                        @endif
                    @endforeach
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
@endsection
