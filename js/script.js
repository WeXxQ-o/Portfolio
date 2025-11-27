// keď sa stránka načíta
document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio loaded! 🚀');
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