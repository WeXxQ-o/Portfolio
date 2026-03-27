document.addEventListener('DOMContentLoaded', function() {
    initAlertDismiss();
    initAccordion();
    initHoverEffects();
});

function initAlertDismiss() {
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
}

function initAccordion() {
    const accordionItems = document.querySelectorAll('.accordion');

    accordionItems.forEach(function(accordion) {
        const question = accordion.querySelector('.question');
        if (question) {
            question.addEventListener('click', function() {
                const isActive = accordion.classList.contains('active');

                accordionItems.forEach(function(item) {
                    if (item !== accordion) {
                        item.classList.remove('active');
                    }
                });

                if (!isActive) {
                    accordion.classList.add('active');
                } else {
                    accordion.classList.remove('active');
                }
            });
        }
    });
}

function initHoverEffects() {
    const cards = document.querySelectorAll('.project-card, .skill-card, .glass-card, .about-content-card');

    cards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}
