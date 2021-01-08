document.querySelector('.btn-down')
.addEventListener('click', () => {
    window.scrollTo({
        top: screen.height - 120,
        behavior: 'smooth'
    });
});