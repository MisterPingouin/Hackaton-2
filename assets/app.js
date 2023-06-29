/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';


// include bootstrap JS
require('bootstrap');
//boostrap css alert auto-close
const alert = document.getElementById('alertMsg');
//close the alert after 2 seconds (2000 milliseconds)
setTimeout(() => {
    alert.remove();
}, 4000);

//ajax on phone choice
document.getElementById('phone_marque').addEventListener('click', function() {
    var marqueId = this.value;

    if (marqueId) {
        fetch('/ajax/modele/' + marqueId)
            .then(response => response.json())
            .then(data => {
                var modeleSelect = document.getElementById('phone_modele');
                modeleSelect.innerHTML = '';

                data.forEach(function(modele) {
                    var option = new Option(modele.name, modele.id);
                    modeleSelect.options.add(option);
                });
            });
    } else {
        document.getElementById('phone_modele').innerHTML = '';
    }
});
// Ajoutez cet écouteur d'événement dans votre fichier JavaScript existant
document.addEventListener("DOMContentLoaded", function() {
    // Fonction pour ajouter l'animation d'entrée depuis la gauche aux champs du formulaire
    function animateFormField(fieldId) {
        var field = document.getElementById(fieldId);
        field.addEventListener('animationend', function() {
            field.classList.remove('slide-in-left');
            field.style.animation = '';
        });
    }
  
    // Appel de la fonction pour chaque champ du formulaire
    animateFormField('choice-marque');
    animateFormField('choice-modele');
    animateFormField('choice-ram');
    animateFormField('choice-stockage');
    animateFormField('choice-etat');
});
  