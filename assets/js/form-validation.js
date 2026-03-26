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
