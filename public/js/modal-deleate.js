let modalDeleate = document.getElementById('modal');
let openDialog = document.getElementById('open-dialog');
let closeDialog = document.getElementById('close-dialog');

openDialog.addEventListener('click', function(){
    modalDeleate.style.display = 'block';
});

closeDialog.addEventListener('click', function(){
    modalDeleate.style.display = 'none';
});
