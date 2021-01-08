let modalKey = document.getElementById('modal-key');
let openKey = document.getElementById('open-key');
let closeKey = document.getElementById('close-key');

openKey.addEventListener('click', function(){
    modalKey.style.display = 'block';
});

closeKey.addEventListener('click', function(){
    modalKey.style.display = 'none';
});
