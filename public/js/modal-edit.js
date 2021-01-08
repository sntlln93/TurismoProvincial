let modalEdit = document.getElementById('modal-edit');
let openEdit = document.getElementById('open-edit');
let closeEdit = document.getElementById('close-edit');

openEdit.addEventListener('click', function(){
    modalEdit.style.display = 'block';
});

closeEdit.addEventListener('click', function(){
    modalEdit.style.display = 'none';
});
