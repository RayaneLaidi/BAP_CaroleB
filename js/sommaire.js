
document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('#burger'); // Ta div avec les hr
    const menu = document.querySelector('.liste-sommaire'); // La div qui contient les liens

    burger.addEventListener('click', function() {
        // "toggle" ajoute la classe si elle n'est pas là, et l'enlève si elle y est
        menu.classList.toggle('is-open');
    });
});
          
       
            
