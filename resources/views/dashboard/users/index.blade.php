@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title">
        <h2>Usuarios del sistema</h2>
    </div>

    <div class="row">
        <div class="add-other only-button">
            <button id="open">
                <i class="icon-plus"></i> Nuevo usuario
            </button>
        </div>
    </div>

    <div id="miModal" class="modal add">
        <div class="flex" id="flex">
            <div class="container-modal">
                <div class="modal-header flex">
                    <h2>Nuevo usuario</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="{{ url('panel-de-administracion/users') }}" method="POST" class="modal-body">
                        @csrf
                        <div>
                            <h4>Nombre:</h4><input class="@error('name') error-input @enderror" type="text" name="name"
                                value="" placeholder="">
                        </div>
                        @error('name') <small class="error-message">{{ $message }}</small> @enderror
                        <div>
                            <h4>Apellido:</h4><input class="@error('lastname') error-input @enderror" type="text"
                                name="lastname" value="" placeholder="">
                        </div>
                        @error('lastname') <small class="error-message">{{ $message }}</small> @enderror
                        <div>
                            <h4>DNI:</h4><input class="@error('dni') error-input @enderror" type="number" name="dni"
                                value="" placeholder="">
                        </div>
                        @error('dni') <small class="error-message">{{ $message }}</small> @enderror
                        <div>
                            <h4>Contraseña:</h4><input class="@error('password') error-input @enderror" type="password"
                                name="password" value="" placeholder="">
                        </div>
                        @error('password') <small class="error-message">{{ $message }}</small> @enderror

                        <!-- ESTO SOLO APARECERÁ PARA EL ROL DE ADMIN CYT -->
                        @if($districts)
                        <div>
                            <h4>Municipio:</h4>
                            <select class="@error('district_id') error-input @enderror" name="district_id" type="text">
                                @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('district_id') <small class="error-message">{{ $message }}</small> @enderror

                        @else
                        <input type="hidden" value="{{ Auth::user()->district_id }}" name="district_id">
                        @endif
                        <button class="save">Guardar<i class="icon-floppy"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="articles user">
        @foreach($users as $user)
        <section class="article">
            <img src="{{ asset('/img/users/user.jpg') }}" style="width: 60px; height: 60px; margin-right: 1em">
            <div class="article-info">
                <div class="info-1">
                    <b>Nombre:</b> {{ $user->full_name }}</br>
                    <b>DNI:</b> {{ $user->dni }}</br>
                </div>
                <div class="info-2">
                    <b>Municipalidad:</b> {{ $user->district->name ?? "-"}}</br>
                    <b>Rol:</b> {{ $user->district_id ? "Municipal" : "Provincial" }}
                </div>
                <div class="info-3">
                    <b>Creado:</b> {{ $user->created_at->diffForHumans() }} </br>
                    <b>Modificado:</b> {{ $user->updated_at->diffForHumans() }}
                </div>
            </div>
            <div class="icon">
                <a href="{{ url('reset-password/'.$user->id) }}" id="open-key" class="btn-key"><i
                        class="icon-key-1"></i></a>
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

@endsection