document.addEventListener('DOMContentLoaded', function() {
    initCardGlow();
    initTextReveal();
    initParallaxGlow();
    initSmoothCounters();
});

function initCardGlow() {
    const cards = document.querySelectorAll('.project-card, .skill-card, .about-content-card, .glass-card');

    cards.forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            card.style.setProperty('--mouse-x', x + 'px');
            card.style.setProperty('--mouse-y', y + 'px');
        });
    });
}

function initTextReveal() {
    const headings = document.querySelectorAll('.hero-section h1, .section-header h1');

    headings.forEach(function(heading) {
        const text = heading.textContent;
        heading.style.opacity = '1';
    });
}

function initParallaxGlow() {
    const glows = document.querySelectorAll('.hero-bg-glow');

    if (glows.length === 0) return;

    let ticking = false;

    window.addEventListener('mousemove', function(e) {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const moveX = (e.clientX - window.innerWidth / 2) * 0.02;
                const moveY = (e.clientY - window.innerHeight / 2) * 0.02;

                glows.forEach(function(glow, index) {
                    const factor = (index + 1) * 0.5;
                    glow.style.transform = 'translate(' + (moveX * factor) + 'px, ' + (moveY * factor) + 'px)';
                });

                ticking = false;
            });
            ticking = true;
        }
    });
}

function initSmoothCounters() {
    const percentages = document.querySelectorAll('.skill-percentage');

    if (percentages.length === 0) return;

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const el = entry.target;
                const text = el.textContent;
                const match = text.match(/(\d+)/);

                if (match) {
                    const target = parseInt(match[1]);
                    animateCounter(el, 0, target, 1500, text.replace(match[1], '{n}'));
                }

                observer.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    percentages.forEach(function(el) {
        observer.observe(el);
    });
}

function animateCounter(element, start, end, duration, template) {
    const startTime = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
        const current = Math.round(start + (end - start) * easeOutQuart);

        element.textContent = template.replace('{n}', current);

        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }

    requestAnimationFrame(update);
}

document.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const heroGlows = document.querySelectorAll('.hero-section .hero-bg-glow');

    heroGlows.forEach(function(glow, index) {
        const speed = 0.3 + (index * 0.1);
        glow.style.transform = 'translateY(' + (scrolled * speed) + 'px)';
    });
}, { passive: true });
