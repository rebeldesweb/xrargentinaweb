var btnVerdad = document.getElementById('btnVerdad');
var btnActuar = document.getElementById('btnActuar');
var btnSumate = document.getElementById('btnSumate');
var btnEmergencia = document.getElementById('btnEmergencia');
var btnDemandas = document.getElementById('btnDemandas');
var btnNosotros = document.getElementById('btnNosotros');
var btnPress = document.getElementById('btnPress');

var url = window.location.href;

if (url.includes('laverdad.php') || url.includes('laemergencia.php') || url.includes('demandas.php') || url.includes('nosotros.php')) {
  btnVerdad.className = 'current-menu-item';
}else if (url.includes('actuarAhora.php')) {
  btnActuar.className = 'current-menu-item';
}else if (url.includes('sumate.php')) {
  btnSumate.className = 'current-menu-item';
}else if (url.includes('prensa.php')) {
  btnPress.className = 'current-menu-item';
};


if (url.includes('laemergencia.php')) {
  btnEmergencia.classList.add("resaltarSubmenu");
}else if (url.includes('demandas.php')) {
  btnDemandas.classList.add("resaltarSubmenu");
}else if (url.includes('nosotros.php')) {
  btnNosotros.classList.add("resaltarSubmenu");
}


// Cambio de color del menu

let header = document.getElementById('header');

if(url.includes('laverdad.php')){
  header.classList.add('bg-pink');
}else if(url.includes('laemergencia.php')){
  header.classList.add('bg-pink');
}else if(url.includes('demandas.php')){
  header.classList.add('bg-pink');
}else if(url.includes('nosotros.php')){
  header.classList.add('bg-pink');
}else if (url.includes('prensa.php')) {
  header.classList.add('bg-purple')
}else if (url.includes('noticia.php') || url.includes('noticias.php')) {
  header.classList.add('bg-yellow')
}

if(url.includes('actuarAhora.php')){
  header.classList.add('bg-blue');
}else if(url.includes('laemergencia.php')){
  header.classList.add('bg-blue');
}else if(url.includes('demandas.php')){
  header.classList.add('bg-blue');
}else if(url.includes('nosotros.php') || url.includes('eventos.php') || url.includes('eventoSingle.php')){
  header.classList.add('bg-blue');
}

if(url.includes('sumate.php')){
  header.classList.add('bg-purple');
}

// ------------------------------------------------------

//para saber la fecha en la que se inscribio el usuario

let input = document.getElementById('input');
let f = new Date();
input.value = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();