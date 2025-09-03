let currentIndex = 0;

document.querySelector('.prev-button').addEventListener('click', () => {
  navigate(-1);
});

document.querySelector('.next-button').addEventListener('click', () => {
  navigate(1);
});

function navigate(direction) {
  const galleryContainer = document.querySelector('.gallery-container');
  const totalImages = document.querySelectorAll('.gallery-item').length;

  currentIndex = (currentIndex + direction + totalImages) % totalImages;
  const offset = -currentIndex * 100;

  galleryContainer.style.transform = `translateX(${offset}%)`;
}

// AUTOPLAY
let autoplayInterval = null;

function startAutoplay(interval) {
  stopAutoplay();  // Evita intervalos múltiples
  autoplayInterval = setInterval(() => {
    navigate(1);
  }, interval);
}

function stopAutoplay() {
  clearInterval(autoplayInterval);
}

// Inicia autoplay cada 3 segundos
startAutoplay(3000);

// Detiene autoplay al interactuar con los botones
document.querySelectorAll('.nav-button').forEach(button => {
  button.addEventListener('click', stopAutoplay);
});
