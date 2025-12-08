// keď sa stránka načíta
// <!-- kreatívny bod -->
document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio loaded! 🚀');
    
    // Hamburger menu funkcionalita - vlastná implementácia bez Bootstrap JS
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
    
    // <!-- kreatívny bod -->
    // Alert dismiss funkcionalita
    const alertCloseButtons = document.querySelectorAll('.alert .btn-close');
    alertCloseButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }
        });
    });
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
// Nájdem formulár na stránke
const contactForm = document.querySelector('.contact-section form');

// Ak formulár existuje, pridám validáciu
if (contactForm) {
    
    // Pri odoslaní formulára
    contactForm.addEventListener('submit', function(event) {
        
        // Získam polia z formulára
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const messageInput = document.getElementById('message');
        const gdprInput = document.getElementById('gdpr');
        
        // Na začiatku je všetko OK
        let isValid = true;
        
        // Odstránim predchádzajúce chyby
        nameInput.classList.remove('is-invalid', 'is-valid');
        emailInput.classList.remove('is-invalid', 'is-valid');
        messageInput.classList.remove('is-invalid', 'is-valid');
        gdprInput.classList.remove('is-invalid', 'is-valid');
        
        // Kontrola mena - musí mať aspoň 2 znaky
        if (nameInput.value.trim().length < 2) {
            nameInput.classList.add('is-invalid');
            isValid = false;
        } else {
            nameInput.classList.add('is-valid');
        }
        
        // Kontrola emailu - musí obsahovať @ a .
        const email = emailInput.value.trim();
        if (!email.includes('@') || !email.includes('.')) {
            emailInput.classList.add('is-invalid');
            isValid = false;
        } else {
            emailInput.classList.add('is-valid');
        }
        
        // Kontrola správy - musí mať aspoň 10 znakov
        if (messageInput.value.trim().length < 10) {
            messageInput.classList.add('is-invalid');
            isValid = false;
        } else {
            messageInput.classList.add('is-valid');
        }
        
        // Kontrola GDPR - musí byť zaškrtnuté
        if (!gdprInput.checked) {
            gdprInput.classList.add('is-invalid');
            isValid = false;
        } else {
            gdprInput.classList.add('is-valid');
        }
        
        // Ak niečo nie je správne, zastavím odoslanie
        if (!isValid) {
            event.preventDefault();
        }
    });
}