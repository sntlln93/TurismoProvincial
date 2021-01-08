window.onscroll= function(){
    if(document.documentElement.scrollTop > 300){
        document.querySelector('.container-btn-top')
        .classList.add('show-btn');
    } else {
        document.querySelector('.container-btn-top')
        .classList.remove('show-btn');
    }
}

document.querySelector('.container-btn-top')
.addEventListener('click', () => {
    window.scrollTo({
        top:0,
        behavior: 'smooth'
    });
});