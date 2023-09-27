// get all images
const images = document.querySelectorAll('.photo');

// openModel/closeModel
images.forEach(image => {
    image.addEventListener('click', (e) => { 
        const modal = e.target.parentNode.querySelector('.modal');
        modal.classList.add('open');
        modal.addEventListener('click', closeModal);
        modal.querySelector('.modal-wrapper').addEventListener('click', closeModal);
    })
})

//closemodel
function closeModal(e) {
    if (e.target.classList.contains('modal-wrapper')) {
        e.target.parentNode.classList.remove('open');
    } else {
        e.target.classList.remove('open');
    }
    }
// function hover() {
//     const image = document.querySelector('.photo');
//     const card = document.querySelector('.card-portfolio');

//     card.addEventListener('click', () => {
//         card.style.removeProperty('transation');
//     })
// }
