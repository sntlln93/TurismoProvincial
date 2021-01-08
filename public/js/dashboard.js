const navUser = () => {
    const iuser = document.querySelector('.iuser');
    const header = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    

    iuser.addEventListener('click', () => {
        //Toggle Nav
        header.classList.toggle('nav-active');
    });
}

navUser();