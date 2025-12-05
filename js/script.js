// keď sa stránka načíta
document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio loaded! 🚀');
    
    // Hamburger menu funkcionalita
    const navbarToggler = document.getElementById('navbarToggler');
    const navbarCollapse = document.getElementById('navbarNav');
    
    if (navbarToggler && navbarCollapse) {
        // Toggle menu pri kliknutí na hamburger
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
            // Aktualizuj aria-expanded atribút pre prístupnosť
            const isExpanded = navbarCollapse.classList.contains('show');
            navbarToggler.setAttribute('aria-expanded', isExpanded);
        });
        
        // Zatvor menu pri kliknutí na link
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                navbarCollapse.classList.remove('show');
                navbarToggler.setAttribute('aria-expanded', 'false');
            });
        });
        
        // Zatvor menu pri kliknutí mimo neho
        document.addEventListener('click', function(event) {
            const isClickInsideNav = navbarToggler.contains(event.target) || navbarCollapse.contains(event.target);
            if (!isClickInsideNav && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
                navbarToggler.setAttribute('aria-expanded', 'false');
            }
        });
    }
});

// FAQ accordion funkcionalita
// získam všetky accordion elementy
const accordionItems = document.getElementsByClassName('accordion');

// prechádzam cez každý accordion a pridávam click listener
for (a of accordionItems){
    a.addEventListener('click', function(){
        // toggle active triedy pre otvorenie/zatvorenie
        this.classList.toggle('active')
    })
}