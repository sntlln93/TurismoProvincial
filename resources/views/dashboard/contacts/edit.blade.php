@extends('dashboard.layouts.app')

@section('content')
    <main>
        <h2>Modificar {{ Str::lower($contact->type) }} de {{ $contact->contactable->name }}</h2>

        <div class="modal-body view">
            <form action="{{ url('panel-de-administracion/contacts/'.$contact->id) }}" method="POST">
                @csrf @method('PUT')
                <div><h4>Contacto:</h4><input type="text" name="contact" value="{{ $contact->contact }}" placeholder=""></div>
            <div>
                <h4>Tipo:</h4>
                <select name="type" id="">
                    <optgroup label="Red social">
                        <option value="Instagram" @if($contact->type == "Instagram") selected @endif>Instagram</option>
                        <option value="Facebook" @if($contact->type == "Facebook") selected @endif>Facebook</option>
                        <option value="Youtube" @if($contact->type == "Youtube") selected @endif>Youtube</option>
                        <option value="Twitter" @if($contact->type == "Twitter") selected @endif>Twitter</option>
                    </optgroup>
                    <optgroup label="Otro">
                        <option value="Número de teléfono" @if($contact->type == "Número de teléfono") selected @endif>Número de teléfono</option>
                        <option value="Sitio web" @if($contact->type == "Sitio web") selected @endif>Sitio web</option>
                    </optgroup>
                </select>
            </div>
                <button type="submit" class="save">Guardar<i class="icon-floppy"></i>    
            </form>
        </div>
    </main>
@endsection

@section('scripts')
@endsection