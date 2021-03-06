let aspectRatio = 16 / 9;

const setAspectRatio = (initialAspectRatio) => {
    aspectRatio = initialAspectRatio;
};

const options = {
    viewMode: 1,
    restore: true,
    aspectRatio: aspectRatio,
    movable: false,
    dragMode: "move",
    cropBoxMovable: true,
    cropBoxResizable: false,
    zoomOnWheel: true,
};

let toCropImages = [];
let croppedImages = 0;

const cropperContainer = document.querySelector(".cropper--container");
const croppedContainer = document.getElementById("croppedContainer");
const imagesToCropInput = document.getElementById("imagesToCropInput");
const previewGallery = document.getElementById("previewGallery");
const cropContainer = document.getElementById("cropContainer");

const cleanSelection = () => {
    const inputs = croppedContainer.querySelectorAll("input[type=hidden]");
    inputs && Array.from(inputs).forEach((input) => input.remove());

    toCropImages = [];

    previewGallery.innerHTML = "";
    removeCropper();
};

const createImg = (photo, index) => {
    const imagePreviewContainer = document.createElement("div");
    imagePreviewContainer.className = "singleImageCanvasContainer";

    const imagePreview = document.createElement("img");
    imagePreview.src = URL.createObjectURL(photo);
    imagePreview.id = `previewImage-${index}`;
    imagePreview.addEventListener("click", () =>
        showCropper(`previewImage-${index}`)
    );

    imagePreviewContainer.appendChild(imagePreview);
    previewGallery.appendChild(imagePreviewContainer);
};

const showPreview = (event) => {
    const photos = event.target.files;

    cleanSelection();

    const hint = document.createElement("p");
    hint.innerText =
        "Clickea una foto para mostrar la herramienta de recorte y luego clickea en el botón 'Recortar' que se encuentra al pie de la herramienta. Las fotos sin recortar no se guardarán.";
    cropperContainer.insertBefore(hint, cropperContainer.firstChild);

    Array.from(photos).forEach((photo, index) => {
        toCropImages.push({ index: index, photo: photo });
        createImg(photo, index);
    });
};

const createInputs = (imagePreviewId, imageData) => {
    const index = imagePreviewId.slice(13, 14);
    const reader = new FileReader();

    reader.onloadend = function () {
        const photoInput = document.createElement("input");
        photoInput.value = reader.result;
        photoInput.name = `photos[${index}][base64]`;
        photoInput.type = "hidden";
        croppedContainer.appendChild(photoInput);

        const xInput = document.createElement("input");
        xInput.value = imageData.x;
        xInput.name = `photos[${index}][x]`;
        xInput.type = "hidden";
        croppedContainer.appendChild(xInput);

        const yInput = document.createElement("input");
        yInput.value = imageData.y;
        yInput.name = `photos[${index}][y]`;
        yInput.type = "hidden";
        croppedContainer.appendChild(yInput);

        const hInput = document.createElement("input");
        hInput.value = imageData.height;
        hInput.name = `photos[${index}][h]`;
        hInput.type = "hidden";
        croppedContainer.appendChild(hInput);

        const wInput = document.createElement("input");
        wInput.value = imageData.width;
        wInput.name = `photos[${index}][w]`;
        wInput.type = "hidden";
        croppedContainer.appendChild(wInput);
    };

    reader.readAsDataURL(toCropImages[index].photo);
};

const removeCropper = () => {
    cropContainer.innerHTML = "";
    const buttons = cropperContainer.getElementsByTagName("button");
    Array.from(buttons).forEach((button) => button.remove());
};

const removeError = () => {
    const cropError = document.getElementById("cropError");
    cropError && cropError.remove();
};

const createError = () => {
    removeError();
    const cropError = document.createElement("small");
    cropError.id = "cropError";
    cropError.className = "error-message";
    cropError.innerText = "Debes recortar todas las imágenes seleccionadas.";
    cropperContainer.insertBefore(cropError, cropperContainer.lastChild);
};

const showCropper = (imagePreviewId) => {
    const photo = document.getElementById(imagePreviewId);

    removeCropper();
    removeError();

    const toCropImage = document.createElement("img");
    toCropImage.src = photo.src;
    cropContainer.appendChild(toCropImage);

    const cropBtn = document.createElement("button");
    cropBtn.className = "cropImageBtn cropBtn";
    cropBtn.id = `cropBtn-${imagePreviewId.slice(13, 14)}`;
    cropBtn.innerText = "Recortar";
    cropperContainer.appendChild(cropBtn);

    const cropper = new Cropper(toCropImage, options);

    const crop = (event, imagePreviewId) => {
        event.preventDefault();
        const previewPhoto = document.getElementById(imagePreviewId);

        const imageData = cropper.getData();
        createInputs(imagePreviewId, imageData);

        var blob = cropper.getCroppedCanvas().toDataURL("image/jpeg");
        previewPhoto.src = blob;
        croppedImages++;
        removeCropper();
    };

    cropBtn.addEventListener("click", (event) => crop(event, imagePreviewId));
};

imagesToCropInput.addEventListener("change", showPreview);

const shouldStopSubmit = () => {
    return toCropImages.length === croppedImages ? false : true;
};

document
    .querySelector("button[type=submit]")
    .addEventListener("click", (event) => {
        if (shouldStopSubmit()) {
            event.preventDefault();
            createError();
        }
    });
