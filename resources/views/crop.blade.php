<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/imagecrop.min.css') }}">
</head>

<body>
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
                fixed_size: true,
                min_crop_width: 480,
                update_cb: function (p) {
                    cropped_image_src = cropper.crop("image/jpeg", 1);
                    croppedInput.value = cropped_image_src;
                    croppedImage.src = cropped_image_src;
                    
                },
            });
                console.log(cropper);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
                console.log(reader);
            }
        }

    fileInput.addEventListener('change', handleCropper);


    </script>


</body>

</html>