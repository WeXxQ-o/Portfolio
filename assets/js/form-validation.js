document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-section form');

    if (!contactForm) return;

    contactForm.addEventListener('submit', function(event) {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const messageInput = document.getElementById('message');
        const gdprInput = document.getElementById('gdpr');

        let isValid = true;

        clearValidation(nameInput);
        clearValidation(emailInput);
        clearValidation(messageInput);
        clearValidation(gdprInput);

        if (nameInput && nameInput.value.trim().length < 2) {
            setInvalid(nameInput);
            isValid = false;
        } else if (nameInput) {
            setValid(nameInput);
        }

        if (emailInput) {
            const email = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                setInvalid(emailInput);
                isValid = false;
            } else {
                setValid(emailInput);
            }
        }

        if (messageInput && messageInput.value.trim().length < 10) {
            setInvalid(messageInput);
            isValid = false;
        } else if (messageInput) {
            setValid(messageInput);
        }

        if (gdprInput && !gdprInput.checked) {
            setInvalid(gdprInput);
            isValid = false;
        } else if (gdprInput) {
            setValid(gdprInput);
        }

        if (!isValid) {
            event.preventDefault();
            const firstInvalid = contactForm.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.focus();
            }
        }
    });

    function clearValidation(input) {
        if (input) {
            input.classList.remove('is-invalid', 'is-valid');
        }
    }

    function setInvalid(input) {
        input.classList.add('is-invalid');
    }

    function setValid(input) {
        input.classList.add('is-valid');
    }
});
