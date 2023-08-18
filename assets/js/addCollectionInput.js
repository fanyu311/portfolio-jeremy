
// recuperer le button
document.querySelectorAll('.btn-add-collection')
    // chaque button on a trouver 
    .forEach(button => {
        // ecout le click -> excuter le function 'addcollectionInput'
        button.addEventListener('click', addCollectionInput)
    });

    // e->parametre ->event
    // automatiquement passer le eventment
function addCollectionInput(e) {
    // cherche dans le dom un class ->concatener 合并
    const inputContent = document.querySelector('.' + e.target.dataset.collectionHolderClass);

    console.error(inputContent);
}