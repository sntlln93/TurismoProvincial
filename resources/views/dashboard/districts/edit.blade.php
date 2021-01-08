@extends('dashboard.layouts.app')

@section('content')
    <main>
        <div class="title" style="margin-bottom: 2em">
            <h2>Modificar Municipio</h2>
        </div>
        <div class="flex" id="flex">
            <div class="container-modal">
                <div class="modal-header flex">
                    <h2>Modificar intendente</h2>
                    <span class="close" id="close-edit">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="{{ url('panel-de-administracion/districts/'.$district->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div><h4>Intendente:</h4><input type="text" name="mayor" value="{{ $district->mayor }}" placeholder=""></div>
                    
                        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
@endsection