document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los indicadores
    const indicadores = document.querySelectorAll('.indicador');
    // Selecciona todos los slides
    const slides = document.querySelectorAll('.slide');
    // Contenedor de slides
    const slidesContainer = document.querySelector('.slides');

    let currentIndex = 0; // Índice actual del slide
    const slideInterval = 5000; // Intervalo en milisegundos (5 segundos)

    // Función para actualizar el slider según el índice
    function updateSlider(index) {
        // Elimina la clase 'active' de todos los indicadores
        indicadores.forEach(indicador => indicador.classList.remove('active'));

        // Agrega la clase 'active' al indicador correspondiente
        indicadores[index].classList.add('active');

        // Desplaza el contenedor de slides para mostrar la imagen correspondiente
        slidesContainer.style.transform = `translateX(-${index * 100}%)`;

        // Actualiza el índice actual
        currentIndex = index;
    }

    // Función para manejar el clic en un indicador
    function handleIndicatorClick(event) {
        // Encuentra el índice del indicador clicado
        const index = Array.from(indicadores).indexOf(event.currentTarget);

        // Actualiza el slider al índice correspondiente
        updateSlider(index);

        // Reinicia el intervalo automático cuando el usuario hace clic
        resetAutoSlide();
    }

    // Añade el manejador de clic a cada indicador
    indicadores.forEach(indicador => {
        indicador.addEventListener('click', handleIndicatorClick);
    });

    // Función para avanzar al siguiente slide
    function nextSlide() {
        const nextIndex = (currentIndex + 1) % slides.length;
        updateSlider(nextIndex);
    }

    // Inicia el intervalo automático
    let autoSlideInterval = setInterval(nextSlide, slideInterval);

    // Función para reiniciar el intervalo automático
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, slideInterval);
    }
});
