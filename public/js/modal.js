let modal = document.getElementById('miModal');
// let flex = document.getElementById('flex');
let open = document.getElementById('open');
let close = document.getElementById('close');

open.addEventListener('click', function(){
    modal.style.display = 'block';
});

close.addEventListener('click', function(){
    modal.style.display = 'none';
});

// window.addEventListener('click', function(e){
//     console.log(e.target);
//     if(e.tarjet === flex){
//         modal.style.display = 'none';
//     }
// });