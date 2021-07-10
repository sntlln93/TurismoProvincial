const croppedContainer = document.getElementById("croppedContainer");
const imagesToCropInput = document.getElementById("imagesToCropInput");

const previewGallery = document.getElementById("previewGallery");
const cropperContainer = document.getElementById("cropper");
const cropImageBtn = document.getElementById("cropImageBtn");
let cropper;

let aspectRatio = 5 / 3;

const setAspectRatio = (newAspectRatio) => {
    aspectRatio = newAspectRatio;
};

const options = {
    viewMode: 1,
    restore: true,
    aspectRatio: aspectRatio,
    movable: false,
    dragMode: "move",
    cropBoxMovable: true,
    cropBoxResizable: false,
    zoomOnWheel: true /**
    ,
    crop: () => (cropImageButton.style.display = "block"), */,
};

const onCropInit = (e) => {
    const photo = e.target;

    const cropperImg = document.createElement("img");
    cropperImg.src = photo.src;
    cropperContainer.appendChild(cropperImg);

    cropImageBtn.style.display = "block";

    cropper = new Cropper(cropperImg, options);
};

const cleanSelection = () => {
    previewGallery.innerHTML = "";
    const inputsToBeDeleted =
        croppedContainer.querySelectorAll(".photosToBeCropped");

    inputsToBeDeleted.forEach((input) => input.remove());
};

const createInput = (value, index) => {
    const photoInput = document.createElement("input");
    photoInput.type = "hidden";
    photoInput.name = `photos[${index}][base64]`;
    photoInput.className = "photosToBeCropped";
    photoInput.value = value;

    croppedContainer.appendChild(photoInput);
};

const createImg = (value) => {
    const photoContainer = document.createElement("div");
    photoContainer.className = "singleImageCanvasContainer";

    const photoImg = document.createElement("img");
    photoImg.src = value;
    photoImg.addEventListener("click", (photoImg) => onCropInit(photoImg));

    photoContainer.appendChild(photoImg);
    previewGallery.appendChild(photoContainer);
};

const onPhotosLoaded = () => {
    const photos = imagesToCropInput.files;

    photos.length &&
        Array.from(photos).forEach((photo, index) => {
            cleanSelection();

            const reader = new FileReader();

            reader.onloadend = () => {
                createInput(reader.result, index);
                createImg(reader.result);
            };

            reader.readAsDataURL(photo);
        });
};

const onCrop = (event) => {
    event.preventDefault();
    console.log(cropper.getData());
    console.log("cropping");
};

imagesToCropInput.addEventListener("change", onPhotosLoaded);
cropImageBtn.addEventListener("click", (event) => onCrop(event));
/**

var c;
var galleryImagesContainer = document.getElementById('galleryImages');
var imageCropFileInput = document.getElementById('imageCropFileInput');
var cropperImageInitCanvas = document.getElementById('cropperImg');
var cropImageButton = document.getElementById('cropImageBtn');

let croppedImages = [];

let aspectRatio = 5 / 3;

const setAspectRatio = (newAspectRatio) => {
    aspectRatio = newAspectRatio;
};

// Crop Function On change
function imagesPreview(input) {
    galleryImagesContainer.innerHTML = '';
    var img = [];
    if (cropperImageInitCanvas.cropper) {
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
            reader.onload = function (event) {
                var blobUrl = event.target.result;
                img.push(new Image());
                img[i].onload = function (e) {
                    // Canvas Container
                    var singleCanvasImageContainer =
                        document.createElement('div');
                    singleCanvasImageContainer.id =
                        'singleImageCanvasContainer' + index;
                    singleCanvasImageContainer.className =
                        'singleImageCanvasContainer';
                    // Canvas Close Btn
                    var singleCanvasImageCloseBtn =
                        document.createElement('button');
                    // var singleCanvasImageCloseBtnText = document.createElement('i');
                    // singleCanvasImageCloseBtnText.className = 'fa fa-times';
                    singleCanvasImageCloseBtn.id =
                        'singleImageCanvasCloseBtn' + index;
                    singleCanvasImageCloseBtn.className =
                        'singleImageCanvasCloseBtn';
                    singleCanvasImageCloseBtn.innerHTML =
                        '<i class='icon-trash-empty'></i>';
                    singleCanvasImageCloseBtn.onclick = function () {
                        removeSingleCanvas(this);
                    };
                    singleCanvasImageContainer.appendChild(
                        singleCanvasImageCloseBtn
                    );
                    // Image Canvas
                    var canvas = document.createElement('canvas');
                    canvas.id = 'imageCanvas' + index;
                    canvas.className = 'imageCanvas singleImageCanvas';
                    canvas.width = e.currentTarget.width;
                    canvas.height = e.currentTarget.height;
                    canvas.onclick = function () {
                        cropInit(canvas.id);
                    };
                    singleCanvasImageContainer.appendChild(canvas);
                    // Canvas Context
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(e.currentTarget, 0, 0);
                    // galleryImagesContainer.append(canvas);
                    galleryImagesContainer.appendChild(
                        singleCanvasImageContainer
                    );
                    while (
                        document.querySelectorAll('.singleImageCanvas')
                            .length == input.files.length
                    ) {
                        var allCanvasImages = document
                            .querySelectorAll('.singleImageCanvas')[0]
                            .getAttribute('id');
                        cropInit(allCanvasImages);
                        break;
                    }
                    urlConversion();
                    index++;
                };
                img[i].src = blobUrl;
                i++;
            };
            reader.readAsDataURL(singleFile);
        }
        // addCropButton();
        // cropImageButton.style.display = 'block';
    }
}
imageCropFileInput.addEventListener('change', function (event) {
    const currentImage = document.querySelector('.current--container');
    if (currentImage) currentImage.style.display = 'none';
    imagesPreview(event.target);
});
// Initialize Cropper
function cropInit(selector) {
    c = document.getElementById(selector);

    if (cropperImageInitCanvas.cropper) {
        cropperImageInitCanvas.cropper.destroy();
    }
    var allCloseButtons = document.querySelectorAll(
        '.singleImageCanvasCloseBtn'
    );
    for (let element of allCloseButtons) {
        element.style.display = 'block';
    }
    c.previousSibling.style.display = 'none';
    // c.id = croppedImg;
    var ctx = c.getContext('2d');
    var imgData = ctx.getImageData(0, 0, c.width, c.height);
    var image = cropperImageInitCanvas;
    image.width = c.width;
    image.height = c.height;
    var ctx = image.getContext('2d');
    ctx.putImageData(imgData, 0, 0);

    const options = {
        viewMode: 1,
        restore: true,
        aspectRatio: aspectRatio,
        movable: false,
        dragMode: 'move',
        cropBoxMovable: true,
        cropBoxResizable: false,
        zoomOnWheel: true,
        crop: () => (cropImageButton.style.display = 'block'),
    };

    cropper = new Cropper(image, options);
}

// Crop Image
function image_crop() {
    if (cropperImageInitCanvas.cropper) {
        var cropcanvas = cropperImageInitCanvas.cropper.getCroppedCanvas({
            width: 250,
            height: 250,
        });

        var ctx = cropcanvas.getContext('2d');
        var imgData = ctx.getImageData(
            0,
            0,
            cropcanvas.width,
            cropcanvas.height
        );

        c.width = cropcanvas.width;
        c.height = cropcanvas.height;
        var ctx = c.getContext('2d');
        ctx.putImageData(imgData, 0, 0);

        console.log(cropperImageInitCanvas.cropper.getData());
        croppedImages.push(cropperImageInitCanvas.cropper.getData());

        cropperImageInitCanvas.cropper.destroy();
        cropperImageInitCanvas.width = 0;
        cropperImageInitCanvas.height = 0;
        cropImageButton.style.display = 'none';
        var allCloseButtons = document.querySelectorAll(
            '.singleImageCanvasCloseBtn'
        );
        for (let element of allCloseButtons) {
            element.style.display = 'block';
        }
        urlConversion();
    } else {
        alert('Please select any Image you want to crop');
    }
}
cropImageButton.addEventListener('click', function (e) {
    e.preventDefault();
    image_crop();
});
// Image Close/Remove
function removeSingleCanvas(selector) {
    selector.parentNode.remove();
    urlConversion();
}

// Get Converted Url
function urlConversion() {
    const croppedContainer = document.getElementById('croppedContainer');
    const allImageCanvas = document.querySelectorAll('.singleImageCanvas');

    const croppedImgInputs = document.querySelectorAll('.croppedImages');

    croppedImgInputs.forEach((input) => input.remove());

    for (let element of allImageCanvas) {
        const croppedImgInput = document.createElement('input');

        croppedImgInput.type = 'hidden';
        croppedImgInput.name = 'photos[]';
        croppedImgInput.classList.add('croppedImages');
        croppedImgInput.value = element.toDataURL('image/jpeg');

        croppedContainer.appendChild(croppedImgInput);
    }
}

const saveData = () => {};

 */
