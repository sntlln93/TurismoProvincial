@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar contacto</h2>
    </div>
    
    <div class="modal-body view">
        <form action="{{ url('panel-de-administracion/contacts/'.$type.'/'.$id) }}" method="POST">
            @csrf
            <div><h4>Contacto:</h4><input type="text" name="contact" value="" placeholder=""></div>
            <div>
                <h4>Tipo:</h4>
                <select name="type" id="">
                    <optgroup label="Red social">
                        <option value="Instagram">Instagram</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Youtube">Youtube</option>
                        <option value="Twitter">Twitter</option>
                    </optgroup>
                    <optgroup label="Otro">
                        <option value="Número de teléfono">Número de teléfono</option>
                        <option value="Sitio web">Sitio web</option>
                    </optgroup>
                </select>
            </div>
            <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
        </form>
    </div>
</main>
@endsection