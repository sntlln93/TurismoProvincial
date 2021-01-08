const msj = document.querySelector('.msj');
const cont = document.querySelector('.cont');

msj.addEventListener('input', function(e) {
    const target = e.target;
    const lngMax = target.getAttribute('maxlength');
    const lngAct = target.value.length;
    cont.innerHTML = `Cantidad de carácteres: ${lngAct}/${lngMax}`;
});