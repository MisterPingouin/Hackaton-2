const navbar = document.getElementById('nav-links');
const navLinks = navbar.getElementsByClassName('nav-link');
const pages = document.getElementsByClassName('main-page');
const togglerIcon = document.getElementById('navbar-collapsed-button');

for (const navLink of navLinks) {
    for (const page of pages) {
        if (navLink.getAttribute("aria-controls") == page.getAttribute('aria-label')) {
            navLink.remove();
        }
    }
}

console.log(togglerIcon.innerHTML)

if (navLinks.length == 0) {
    togglerIcon.remove();
}

