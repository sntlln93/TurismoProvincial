@extends('dashboard.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css">

<style>
    .error-message {
        color: red;
        margin: 0 0 1em 0;
        font-weight: 500;
        text-align: right;
    }

    .error-input {
        border-color: red !important;
    }

    .cropper--container {
        width: 75% !important;
        margin-right: 10px;
        margin-left: auto;
        display: flex;
        flex-direction: column;
    }

    #galleryImages,
    #cropper {
        width: 100%;
        float: left;
    }

    canvas {
        max-width: 100%;
        display: inline-block;
    }

    #cropperImg {
        /*max-width: 0;
    max-height: 0;*/
    }

    #cropImageBtn {
        display: none;
        margin: .6em;
        padding: .6em;
        border-radius: 5px;
        box-shadow: 10px;
        background: #4032ac;
        border: 0;
        color: var(--second-color);
    }

    img {
        width: 100%;
    }

    .img-preview {
        float: left;
    }

    .singleImageCanvasContainer {
        max-width: 300px;
        display: inline-block;
        position: relative;
        margin: 2px;
    }

    .singleImageCanvasCloseBtn {
        position: absolute !important;
        top: 5px;
        right: 5px;
        display: none;
        margin: .6em;
        padding: .6em;
        border-radius: 5px;
        box-shadow: 10px;
        background: var(--first-color);
        color: var(--second-color);
        border: 0;
    }
</style>
@endsection

@section('content')
<main>
    <div class="title-dashboard">
        <a href="{{ URL::previous() }}"><i class="icon-reply-1"></i></a>
        <h2>Agregar fotos</h2>
    </div>

    <form action="{{ url('panel-de-administracion/photos/'.$type.'/'.$id) }}" method="POST"
        enctype="multipart/form-data" class="modal-body">
        @csrf
        <div id="croppedContainer">
            <h4>Fotos:</h4><input id="imageCropFileInput" class="@error('photos') error-input @enderror" type="file"
                accept="image/jpeg" multiple>
        </div>
        @error('photos') <small class="error-message">{{ $message }}</small> @enderror

        <div class="cropper--container">
            <input type="hidden" id="croppedImgs">
            <div id="galleryImages"></div>
            <div id="cropper">
                <canvas id="cropperImg" width="0" height="0"></canvas>
            </div>
            <button class="cropImageBtn cropBtn" id="cropImageBtn">Recortar</button>
        </div>

        <button type="submit" class="save">Guardar<i class="icon-floppy"></i>
    </form>
</main>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    var c;
    var galleryImagesContainer = document.getElementById('galleryImages');
    var imageCropFileInput = document.getElementById('imageCropFileInput');
    var cropperImageInitCanvas = document.getElementById('cropperImg');
    var cropImageButton = document.getElementById('cropImageBtn');
    // Crop Function On change
    function imagesPreview(input) {
        var cropper;
        galleryImagesContainer.innerHTML = '';
        var img = [];
        if(cropperImageInitCanvas.cropper){
        cropperImageInitCanvas.cropper.destroy();
        cropImageButton.style.display = 'none';
        cropperImageInitCanvas.width = 0;
        cropperImageInitCanvas.height = 0;
        }
        if (input.files.length) {
        var i = 0;
        var index = 0;
        for (let singleFile of input.files) {
            var reader = new FileReader();
            reader.onload = function(event) {
            var blobUrl = event.target.result;
            img.push(new Image());
            img[i].onload = function(e) {
                // Canvas Container
                var singleCanvasImageContainer = document.createElement('div');
                singleCanvasImageContainer.id = 'singleImageCanvasContainer'+index;
                singleCanvasImageContainer.className = 'singleImageCanvasContainer';
                // Canvas Close Btn
                var singleCanvasImageCloseBtn = document.createElement('button');
                // var singleCanvasImageCloseBtnText = document.createElement('i');
                // singleCanvasImageCloseBtnText.className = 'fa fa-times';
                singleCanvasImageCloseBtn.id = 'singleImageCanvasCloseBtn'+index;
                singleCanvasImageCloseBtn.className = 'singleImageCanvasCloseBtn';
                singleCanvasImageCloseBtn.innerHTML = '<i class="icon-trash-empty"></i>';
                singleCanvasImageCloseBtn.onclick = function() { removeSingleCanvas(this) };
                singleCanvasImageContainer.appendChild(singleCanvasImageCloseBtn);
                // Image Canvas
                var canvas = document.createElement('canvas');
                canvas.id = 'imageCanvas'+index;
                canvas.className = 'imageCanvas singleImageCanvas';
                canvas.width = e.currentTarget.width;
                canvas.height = e.currentTarget.height;
                canvas.onclick = function() { cropInit(canvas.id); };
                singleCanvasImageContainer.appendChild(canvas)
                // Canvas Context
                var ctx = canvas.getContext('2d');
                ctx.drawImage(e.currentTarget,0,0);
                // galleryImagesContainer.append(canvas);
                galleryImagesContainer.appendChild(singleCanvasImageContainer);
                while (document.querySelectorAll('.singleImageCanvas').length == input.files.length) {
                var allCanvasImages = document.querySelectorAll('.singleImageCanvas')[0].getAttribute('id');
                cropInit(allCanvasImages);
                break;
                };
                urlConversion();
                index++;
            };
            img[i].src = blobUrl;
            i++;
            }
            reader.readAsDataURL(singleFile);
        }
        // addCropButton();
        // cropImageButton.style.display = 'block';
        }
    }
    imageCropFileInput.addEventListener("change", function(event){
        imagesPreview(event.target);
    });
    // Initialize Cropper
    function cropInit(selector) {
        c = document.getElementById(selector);
        console.log(document.getElementById(selector));
        if(cropperImageInitCanvas.cropper){
            cropperImageInitCanvas.cropper.destroy();
        }
        var allCloseButtons = document.querySelectorAll('.singleImageCanvasCloseBtn');
        for (let element of allCloseButtons) {
        element.style.display = 'block';
        }
        c.previousSibling.style.display = 'none';
        // c.id = croppedImg;
        var ctx=c.getContext('2d');
        var imgData=ctx.getImageData(0, 0, c.width, c.height);
        var image = cropperImageInitCanvas;
        image.width = c.width;
        image.height = c.height;
        var ctx = image.getContext('2d');
        ctx.putImageData(imgData,0,0);
        const aspectRatio = 16 / 9;

        const options = {
                viewMode: 1,
                restore: true,
                aspectRatio: aspectRatio,
                movable: false,
                dragMode: 'move',
                cropBoxMovable: true,
                cropBoxResizable: false,
                zoomOnWheel: false
            };

        cropper = new Cropper(image, {
            viewMode: 1,
                restore: true,
                aspectRatio: aspectRatio,
                movable: false,
                dragMode: 'move',
                cropBoxMovable: true,
                cropBoxResizable: false,
                zoomOnWheel: false,
        crop: function(event) {
            // console.log(event.detail.x);
            // console.log(event.detail.y);
            // console.log(event.detail.width);
            // console.log(event.detail.height);
            // console.log(event.detail.rotate);
            // console.log(event.detail.scaleX);
            // console.log(event.detail.scaleY);
            cropImageButton.style.display = 'block';
        }
        });

    }
    // Initialize Cropper on CLick On Image
    // function cropInitOnClick(selector) {
    //   if(cropperImageInitCanvas.cropper){
    //       cropperImageInitCanvas.cropper.destroy();
    //       // cropImageButton.style.display = 'none';
    //       cropInit(selector);
    //       // addCropButton();
    //       // cropImageButton.style.display = 'block';
    //   } else {
    //       cropInit(selector);
    //       // addCropButton();
    //       // cropImageButton.style.display = 'block';
    //   }
    // }
    // Crop Image
    function image_crop() {
        if(cropperImageInitCanvas.cropper){
        var cropcanvas = cropperImageInitCanvas.cropper.getCroppedCanvas({width: 250, height: 250});
        // document.getElementById('cropImages').appendChild(cropcanvas);
        var ctx=cropcanvas.getContext('2d');
            var imgData=ctx.getImageData(0, 0, cropcanvas.width, cropcanvas.height);
            // var image = document.getElementById(c);
            c.width = cropcanvas.width;
            c.height = cropcanvas.height;
            var ctx = c.getContext('2d');
            ctx.putImageData(imgData,0,0);
            cropperImageInitCanvas.cropper.destroy();
            cropperImageInitCanvas.width = 0;
            cropperImageInitCanvas.height = 0;
            cropImageButton.style.display = 'none';
            var allCloseButtons = document.querySelectorAll('.singleImageCanvasCloseBtn');
            for (let element of allCloseButtons) {
            element.style.display = 'block';
            }
            urlConversion();
            // cropperImageInitCanvas.style.display = 'none';
        } else {
        alert('Please select any Image you want to crop');
        }
    }
    cropImageButton.addEventListener("click", function(e){
        e.preventDefault();
        image_crop();
    });
    // Image Close/Remove
    function removeSingleCanvas(selector) {
        selector.parentNode.remove();
        urlConversion();
    }
    // Dynamically Add Crop Btn
    // function addCropButton() {
    //   // add crop button
    //     var cropBtn = document.createElement('button');
    //     cropBtn.setAttribute('type', 'button');
    //     cropBtn.id = 'cropImageBtn';
    //     cropBtn.className = 'btn btn-block crop-button';
    //     var cropBtntext = document.createTextNode('crop');
    //     cropBtn.appendChild(cropBtntext);
    //     document.getElementById('cropper').appendChild(cropBtn);
    //     cropBtn.onclick = function() { image_crop(cropBtn.id); };
    // }
    // Get Converted Url
    function urlConversion() {
        const croppedContainer = document.getElementById('croppedContainer');
        const allImageCanvas = document.querySelectorAll('.singleImageCanvas');
        
        const croppedImgInputs = document.querySelectorAll('.croppedImages');

        croppedImgInputs.forEach(input => input.remove());

        for (let element of allImageCanvas) {
            const croppedImgInput = document.createElement('input');
            
            croppedImgInput.type = "hidden";
            croppedImgInput.name = "photos[]";
            croppedImgInput.classList.add("croppedImages");
            croppedImgInput.value = element.toDataURL('image/jpeg');;

            croppedContainer.appendChild(croppedImgInput);
        }
    }

</script>
@endsection