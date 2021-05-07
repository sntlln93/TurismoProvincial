const carrusel = (images_array, url) => {
    //Images
    const images = images_array;

    //Elemento para cargar el Slider
    const slider = document.getElementById("slider-js");

    //Elemento general del slider
    const sliderContainer = document.getElementById("slider-container");

    //Ancho del contenedor en función de las imagenes
    slider.style.width = images.length * 100 + "%";

    //Elemento para cargar la navegación
    const sliderNav = document.getElementById("slider-navigation");

    //Variable para saber si el slider está activo
    let active = true;

    //Evento para saber cuando el usuario coloca o no el pointer sobre el slider
    sliderContainer.addEventListener("mouseover", () => {
        if (active) active = false;
    });

    sliderContainer.addEventListener("mouseover", () => {
        if (!active) active = true;
    });

    //Evento al hacer click en la navegación
    sliderNav.addEventListener("click", (e) =>
        slideImage(e.target.id.slice(-1))
    );

    //Dibujar slide y navegación
    for (let img in images) {
        //Cargar imagenes
        const imgElement = document.createElement("img");
        imgElement.src = `${url}/${images[img]}`;
        imgElement.classList.add("slider-image");
        slider.appendChild(imgElement);
        
        //Cargar navegación
        const spanElement = document.createElement("span");
        spanElement.classList.add("slider-nav");
        img == 0 && spanElement.classList.add("slider-nav--active" );
        spanElement.id = `slider-nav-${img}`;
        sliderNav.appendChild(spanElement);
    }

    //Variable contador de img
    let cont = 0;

    //Intervalos de tiempo para el contador
    const startInterval = () => setInterval(counter, 3500);

    //Iniciar el contador
    startInterval();

    //Función que cambia de imagen
    function counter() {
        if (active) {
            cont++;
            if (cont >= images.length) cont = 0;
            setInterval(slideImage(cont), 3500);
            setInterval(setActive(cont), 3500);
        }
    }

    function slideImage(id) {
        if (!active && !isNaN(id)) {
            cont = id;
            setActive(id);
        }

        slider.style.left = "-" + id + "00%";
    }

    const navIcons = document.getElementsByClassName("slider-nav");

    function setActive(id) {
        for (let icon in navIcons) {
            if (icon < navIcons.length) {
                if (navIcons[icon].id === "slider-nav-" + id) {
                    document
                        .getElementById(navIcons[icon].id)
                        .classList.add("slider-nav--active");
                } else {
                    document
                        .getElementById(navIcons[icon].id)
                        .classList.remove("slider-nav--active");
                }
            }
        }
    }
};

carrusel();
