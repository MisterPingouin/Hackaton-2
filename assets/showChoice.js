const marque = document.getElementById('choice-marque');
const modele = document.getElementById('choice-modele');
const ram = document.getElementById('choice-ram');
const stockage = document.getElementById('choice-stockage');
const etat = document.getElementById('choice-etat');
const bouton = document.getElementById('choice-btn');

const formFields = [marque, modele, ram, stockage, etat, bouton];

for (let i = 0; i < formFields.length; i++) {
    formFields[i].addEventListener('change', function (event) {
        event.preventDefault();
        formFields[i+1].classList.toggle('d-none')
    })
}