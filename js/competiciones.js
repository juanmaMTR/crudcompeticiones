'use strict';

function anadirCampo(){
  let botones = document.querySelectorAll('input[type="button"]');
  for(let i=0; i<botones.length;i++){
    let campo = document.createElement('input');
    botones[i].parentNode.insertBefore(campo, botones[i].nextSibling);
    campo.setAttribute('type', 'text');
    campo.setAttribute('name', 'jugador[]');
    campo.setAttribute('placeholder', 'Nombre Jugador...');
    let boton = document.createElement('input');
    botones[i].parentNode.insertBefore(boton, campo.nextSibling);
    boton.setAttribute('type', 'button');
    boton.setAttribute('value', '+');
    boton.setAttribute('onclick', 'anadirCampo()');
    break;
  }
}
