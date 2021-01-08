const msjEdit = document.querySelector('.msjEdit');
const contEdit = document.querySelector('.contEdit');

msjEdit.addEventListener('input', function(e) {
    const target = e.target;
    const lngMax = target.getAttribute('maxlength');
    const lngAct = target.value.length;
    contEdit.innerHTML = `Cantidad de carácteres: ${lngAct}/${lngMax}`;
});