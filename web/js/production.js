'use strict';

window.addEventListener('load', function(){

    let links;
    links = document.querySelectorAll('.delete');
    for (let link of links){
        link.addEventListener('click', (event) => {
            if (confirm('Supprimer la production ?')){
                return true;
            }
            event.preventDefault();
        });
    }
});