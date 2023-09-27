function goTop() {

    const btnFooter = document.querySelector('.ph-arrow-up')

    if (btnFooter) {
        btnFooter.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
              });
        })
    }
}
goTop()