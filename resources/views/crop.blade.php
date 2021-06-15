@extends('dashboard.layouts.app')

@section('content')
<main>
    <input type="file"><br>

    <div id="cropperContainer"></div>

    <form action="{{ url('crop') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input id="cropped_image" type="hidden" name="img" value="">
        <img src="" alt="" id="croppedImage">
        <button>submit</button>
    </form>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/imagecrop.min.js') }}"></script>
<script>
    const croperContainer =  document.getElementById("cropperContainer");
        const fileInput = document.querySelector('input[type=file]');
        const croppedInput = document.querySelector('#cropped_image');
        const croppedImage = document.querySelector('#croppedImage');

        const handleCropper = () => {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                var cropper = new ImageCropper(croperContainer, reader.result, {
                    max_width: 1920,
                    max_height: 1080,
                    fixed_size: false,
                    update_cb: function (p) {
                        cropped_image_src = cropper.crop("image/jpeg", 1);
                        croppedInput.value = cropped_image_src;
                        croppedImage.src = cropped_image_src;
                    },
                });
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        fileInput.addEventListener('change', handleCropper);
</script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/imagecrop.min.css') }}">
@endsection