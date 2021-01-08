
const accordionItem = document.querySelectorAll('.accordion-header');

accordionItem.forEach(accordionItem => {
    accordionItem.addEventListener('click', event => {
        const currentlyActive = document.querySelector('.accordion-header.active');
        if(currentlyActive && currentlyActive!==accordionItem){
            currentlyActive.classList.toggle('active');
            currentlyActive.nextElementSibling.style.maxHeight = 0;
        }

        accordionItem.classList.toggle('active');
        const accordionItemBody = accordionItem.nextElementSibling;
        if(accordionItem.classList.contains('active')) {
            accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
        }
        else {
            accordionItemBody.style.maxHeight = 0;
        }
    });
});
