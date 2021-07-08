@extends('dashboard.layouts.app')

@section('styles')
@include('dashboard.preferences._styles')
@endsection

@section('content')
<main>
    <div class="title">
        <h2>Preferencias de página web</h2>
        <p class="subtitle">Verás estos cambios en <a href="{{ url($preferences->district->slug) }}">el sitio web de
                {{ $preferences->district->name }}</a></p>
    </div>

    <div class="enable-edit">
        <span>Habilitar edición</span>
        <label class="switch">
            <input type="checkbox" id="enable-edit">
            <span class="slider round"></span>
        </label>
    </div>

    <div class="modal-body preferences">
        <form action="{{ url('dashboard/preferences/'.$preferences->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="rows">
                <div>
                    <h4>Fuente:</h4>
                    <select name="font_family" id="font_family" type="text">
                        <option value="Montserrat" style="font-family: 'Montserrat', sans-serif;" @if($preferences->
                            font_family == "Montserrat") selected @endif
                            >
                            Montserrat
                        </option>
                        <option value="Roboto" style="font-family: 'Roboto', sans-serif;" @if($preferences->font_family
                            == "Roboto") selected @endif
                            >
                            Roboto
                        </option>
                        <option value="Nunito" style="font-family: 'Nunito', sans-serif;" @if($preferences->font_family
                            == "Nunito") selected @endif
                            >
                            Nunito
                        </option>
                    </select>
                </div>
            </div>
            <div class="rows">
                <div>
                    <h4>Color principal:</h4><input class="color__input" type="color" id="primary_color"
                        name="primary_color" value="{{ $preferences->primary_color }}">
                </div>
            </div>
            <div class="rows">
                <div>
                    <h4>Color secundario</h4><input class="color__input" type="color" id="secondary_color"
                        name="secondary_color" value="{{ $preferences->secondary_color }}">
                </div>
            </div>
            <div class="rows" style="flex-direction: column">
                <div>
                    <h4>Logo:</h4><input type="file" id="logo_picker" name="logo" accept="image/png, image/svg">
                </div>
            </div>

            <div class="site__preview">
                <div class="logo__container" id="header">
                    <img class="logo__img" id="logo_img" src="{{ $preferences->logo }}"
                        alt="{{ $preferences->district->slug }}">
                </div>
                <div class="logo__content" id="main">
                    <h2 class="text__preview">Texto de prueba</h2>
                </div>
                <div class="logo__footer" id="footer">
                    <p class="text__preview">Texto de prueba</p>
                </div>
            </div>

            <button type="submit" id="submit" class="save" disabled>Guardar nuevas preferencias<i
                    class="icon-floppy"></i>
        </form>
    </div>

</main>
@endsection

@section('scripts')
<script src="{{ asset('js/accordion.js') }}"></script>
<script>
    const logoPicker = document.getElementById("logo_picker");
    const container = document.getElementById("logo_img");

    const updateContainer = () => {
        const files = logoPicker.files;

        if (FileReader && files && files.length) {
            const reader = new FileReader();
            reader.onload = function () {
                container.src = reader.result;
            }
            reader.readAsDataURL(files[0]);
        }
    }

    logoPicker.addEventListener('change', updateContainer);
</script>

<script>
    const primaryPicker = document.getElementById("primary_color");
    const secondaryPicker = document.getElementById("secondary_color");
    const fontPicker = document.getElementById("font_family");

    const header = document.getElementById("header");
    const footer = document.getElementById("footer");
    const texts = document.getElementsByClassName("text__preview");

    const updateHeader = () => {
        header.style.backgroundColor = primaryPicker.value;
    }

    const updateFooter = () => {
        footer.style.backgroundColor = secondaryPicker.value;
    }

    const updateTexts = () => {
        Array.from(texts).forEach(text => {
            text.style.fontFamily = fontPicker.value;
        });
    }

    primaryPicker.addEventListener('change', updateHeader);
    secondaryPicker.addEventListener('change', updateFooter);
    fontPicker.addEventListener('change', updateTexts);

</script>

<script>
    const editSwitch = document.getElementById("enable-edit");
    const submitBtn = document.getElementById("submit");

    let is_editable = false;

    const enableForm = () => {
        submitBtn.disabled = is_editable;
        is_editable = ! is_editable;
    }

    submitBtn.disabled = ! is_editable;

    editSwitch.addEventListener('click', enableForm);
</script>
@endsection