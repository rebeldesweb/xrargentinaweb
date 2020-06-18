let noticias = document.getElementById('noticias');
fetch('backend/listarNoticias.php')
.then(res=>res.json())
.then(newRes=>{
    // console.log(newRes);
    let template = '';
    newRes.forEach(reg => {
        template += `
        <li>                
            <a class="article__recent__title" href="noticia.php?id=${reg.id}">
                <span class="posts-widget-sidbar__date">${reg.fecha}</span>
                ${reg.titulo}            
            </a>
        </li>
        `;
    });
    // console.log(newRes.length);
    if (newRes.length == 0) {
        template = '<center><div class="alert alert-info">No hay noticias cargadas en este momento</div></center>'
    }
    noticias.innerHTML = template;
})

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return parseInt(results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " ")));
}

function ampliarImagen(event) {
    console.log(event.target.src);
    let fotoGrande = document.getElementById('fotoGrande');
    fotoGrande.src = event.target.src
}

window.onload = async ()=>{
    let fotoLista = document.getElementById('foto-lista');
    fotoLista.style.display = 'none';
    let id = await getParameterByName('id');
    fetch(`backend/listarImagenesPorNoticia.php?id=${id}`).then(res=>res.json()).then(response=>{
        if (response.length>0) {
            console.log(response);
            let template = '';
            response.forEach(img=>{
                template+= `
                    <img onclick="ampliarImagen(event)" src="http://xrargentina.org/img/noticias/${img.imagen}"/>
                `;
            })
            fotoLista.innerHTML += template;
            fotoLista.style.display = 'block';
        };
    });
}