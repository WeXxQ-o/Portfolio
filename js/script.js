// keď sa stránka načíta
document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio loaded! 🚀');
});

const accordionItems = document.getElementsByClassName('accordion');
for (a of accordionItems){
    a.addEventListener('click', function(){
        this.classList.toggle('active')
    })
}