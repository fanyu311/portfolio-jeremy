// On récupère l'élément HTML balise a pour pouvoir ajouter la classe open au click
let burgerBtn = document.querySelector('.link-burger');

// On récupère l'élément HTML balise ul avec le menu pour ajouter la classe open au click sur
// l'élément burgerBtn
let navbarLinks = document.querySelector('.menu-roulent ul');

// On vérifie que les éléments sont bien trouvés
if (burgerBtn && navbarLinks) {
    // On ajoute une écoute d'évènement sur le bouton
    burgerBtn.addEventListener('click', () => {
        // On ajoute ou enlève la class open sur les éléments concernés pour ouvrir le
        // Menu
        burgerBtn.classList.toggle('open');
        navbarLinks.classList.toggle('open');
    });
}