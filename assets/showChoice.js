const marque = document.getElementById('choice-marque');
const modele = document.getElementById('choice-modele');
const ram = document.getElementById('choice-ram');
const stockage = document.getElementById('choice-stockage');
const bouton = document.getElementById('choice-btn');

marque.addEventListener('click', function (event) {
    event.preventDefault();
    if (modele.classList.contains('d-none')) {
        modele.classList.remove('d-none');}
})
modele.addEventListener('click', function (event) {
    event.preventDefault();
    if (ram.classList.contains('d-none')) {
        ram.classList.remove('d-none');}
})
ram.addEventListener('click', function (event) {
    event.preventDefault();
    if (stockage.classList.contains('d-none')) {
        stockage.classList.remove('d-none');}
})
stockage.addEventListener('click', function (event) {
    event.preventDefault();
    if (bouton.classList.contains('d-none')) {
        bouton.classList.remove('d-none');}
})