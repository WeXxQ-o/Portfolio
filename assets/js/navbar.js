document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.getElementById('navbarToggler');
    const navbarCollapse = document.getElementById('navbarNav');

    if (!navbarToggler || !navbarCollapse) return;

    navbarToggler.addEventListener('click', function() {
        navbarCollapse.classList.toggle('show');
        const isExpanded = navbarCollapse.classList.contains('show');
        navbarToggler.setAttribute('aria-expanded', isExpanded);
    });

    const navLinks = navbarCollapse.querySelectorAll('.nav-link');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            navbarCollapse.classList.remove('show');
            navbarToggler.setAttribute('aria-expanded', 'false');
        });
    });

    document.addEventListener('click', function(event) {
        const isClickInsideNav = navbarToggler.contains(event.target) || navbarCollapse.contains(event.target);
        if (!isClickInsideNav && navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
            navbarToggler.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
            navbarToggler.setAttribute('aria-expanded', 'false');
        }
    });
});
