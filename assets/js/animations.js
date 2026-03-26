// <!-- kreatívny bod -->
// Alert dismiss funkcionalita
document.addEventListener('DOMContentLoaded', function() {
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
