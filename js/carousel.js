document.addEventListener('DOMContentLoaded', function()  {

let currentSlide = 0;

function moveSlide(direction) {
  const slides = document.querySelectorAll('.carousel-slide');
  
  // Enlever la classe active de la slide actuelle
  slides[currentSlide].classList.remove('active');
  
  // Calculer le nouvel index
  currentSlide += direction;
  
  // Boucler si on dépasse
  if (currentSlide >= slides.length) {
    currentSlide = 0;
  } else if (currentSlide < 0) {
    currentSlide = slides.length - 1;
  }
  
  // Ajouter la classe active à la nouvelle slide
  slides[currentSlide].classList.add('active');
}

// Optionnel : Défilement automatique toutes les 5 secondes
setInterval(() => moveSlide(1), 5000);
});