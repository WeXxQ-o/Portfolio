

// keď sa stránka načíta
document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio loaded! 🚀');
    
    // smooth scroll pre navigačné linky
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // zvýraznenie aktívneho linku v navbar pri scrollovaní
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(15, 15, 22, 0.95)';
        } else {
            navbar.style.backgroundColor = 'rgba(15, 15, 22, 0.8)';
        }
    });
});
