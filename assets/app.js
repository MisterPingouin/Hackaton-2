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

