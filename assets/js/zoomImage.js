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

//open-close photo
function closeModal(e) {
    if (e.target.classList.contains('modal-wrapper')) {
        e.target.parentNode.classList.remove('open');
    } else {
        e.target.classList.remove('open');
    }
    }

