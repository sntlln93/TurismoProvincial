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
                    <form action="{{ url('panel-de-administracion/users') }}" method="POST">
                        @csrf
                        <div><h4>Nombre:</h4><input type="text" name="name" value="" placeholder=""></div>
                        <div><h4>Apellido:</h4><input type="text" name="lastname" value="" placeholder=""></div>
                        <div><h4>DNI:</h4><input type="number" name="dni" value="" placeholder=""></div>
                        <div><h4>Contraseña:</h4><input type="password" name="password" value="" placeholder=""></div>
                        <!-- LA ULTIMA OPCION APARECERÁ SOLO PARA EL ROL DE ADMIN CYT -->
                            <div><h4>Rol:</h4>
                                <select name="role_id" type="text" >
                                    <option>Elegí un rol</option>
                                    @foreach($roles as $role)
                                        @if($role->name != "Gestor de Contenidos")
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        
                        <!-- ESTO SOLO APARECERÁ PARA EL ROL DE ADMIN CYT -->
                        @if($districts)
                            <div><h4>Municipio:</h4>
                                <select name="district_id" type="text">
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                        <b>DNI:</b>  {{ $user->dni }}</br>
                    </div>
                    <!-- Esto (info-2) solo aparece para el rol "admin CyT" -->
                    <div class="info-2">
                        <b>Municipalidad:</b> {{ $user->district->name ?? "-"}}</br>
                        <b>Rol:</b> {{ $user->role->name }}
                    </div>
                    <div class="info-3">
                        <b>Creado:</b> {{ $user->created_at->diffForHumans() }} </br>
                        <b>Modificado:</b> {{ $user->updated_at->diffForHumans() }}
                    </div>
                </div>
                <div class="icon">
                    <a href="{{ url('reset-password/'.$user->id) }}" id="open-key" class="btn-key"><i class="icon-key-1"></i></a>  
                </div>
            </section>
        @endforeach
    </div>
  
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/modal.js') }}"></script>
@endsection