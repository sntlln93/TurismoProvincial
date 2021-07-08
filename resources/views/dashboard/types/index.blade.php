@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Subtipo de servicio</h2>
    </div>

    <div class="row">
        <div class="add-other only-button">
            <button id="open">
                <i class="icon-plus"></i> Nuevo subtipo
            </button>
        </div>
    </div>

    <div id="miModal" class="modal add">
        <div class="flex" id="flex">
            <div class="container-modal">
                <div class="modal-header flex">
                    <h2>Nuevo subtipo de servicio</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dashboard/types') }}" method="POST">
                        @csrf
                        <div>
                            <h4>Tipo:</h4>
                            <select name="type_id">
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                                value="" placeholder="">
                        </div>
                        @error('name') <small class="error-message">{{ $message }}</small> @enderror
                        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion articles">
        @foreach($types as $type)
        <div class="accordion-item">
            <div class="accordion-header">
                @if($type->name == "Alojamiento")
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
            <div class="accordion-body">
                @foreach($type->subTypes as $sub_type)
                <div class="article">
                    <div class="article-info">
                        <div class="info-1 servicetype">
                            <b>{{ $sub_type->name }}</b>
                        </div>
                        <div class="info-2 servicetype">
                            <b>Creado:</b> {{ $sub_type->created_at->diffForHumans() }} </br>
                            <b>Modificado:</b> {{ $sub_type->updated_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="icon">
                        <a href="{{ url('dashboard/types/'.$sub_type->id.'/edit') }}" class="btn-edit" id="open-edit"><i
                                class="icon-edit"></i></a>
                        <form action="{{ url('dashboard/types/'.$sub_type->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-delete" type="submit"><i class="icon-trash-empty"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <div id="modal-edit" class="modal edit">
        <div class="flex" id="flex">
            <div class="container-modal">
                <div class="modal-header flex">
                    <h2>Modificar localidad</h2>
                    <span class="close" id="close-edit">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div>
                            <h4>Tipo:</h4>
                            <select name="type" type="text">
                                <option>Alojamiento</option>
                                <option>Gastronomía</option>
                                <option>Transporte</option>
                            </select>
                        </div>
                        <div>
                            <h4>Nombre:</h4><input type="text" name="name" value="" placeholder="">
                        </div>
                        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/accordion.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>

@if ($errors->any())
<script>
    const createForm = document.getElementById("miModal");
            createForm.style.display = "block";

</script>
@endif

@endsection