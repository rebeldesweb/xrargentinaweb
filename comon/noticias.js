window.onload = ()=>{
    let params = getParameterByName('categoria');
    if (params !== null && params !== '') {
        verNoticiaPorCategoria(parseInt(params));
        return;
    }
    getNoticias();
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    if(results !== null)return results[1];
    return results;
}

let tituloSeccion = document.getElementById('titulo-seccion');

function getNoticias(){
    let noticias = document.getElementById('noticias');
    noticias.innerHTML = 'Obteniendo noticias';
    fetch('backend/listarNoticias.php')
    .then(res=>res.json())
    .then(newRes=>{
        console.log(newRes);
        let template = '';
        // console.log(newRes.length);
        if (newRes.length == 0) {
            template = '<center><div class="alert alert-info">No hay noticias cargadas en este momento</div></center>'
        }else{
            newRes.forEach(reg => {
                if (reg.noticiaImagen == 'noDisponible.jpg') {
                    template += `
                        <article class="tease tease-post" id="tease-${reg.id}">
                            <div class="tease-post__wrap js-masonry-grid-content is-video">
                                <div class="tease-post__body">
                                    <h2 class="h2"><a href="noticia.php?id=${reg.id}">${reg.titulo}</a></h2>
                                    <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                                    <p class="tease-post__preview">${reg.noticia.substring(0,500)}&hellip;</p>
        
                                    <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                                </div>
                            </div>
                        </article>
                    `;
                }else if(reg.link != null && reg.link != ''){
                    template +=`
                        <article class="tease tease-post" id="tease-${reg.id}">
                            <div class="tease-post__wrap js-masonry-grid-content is-video">
                                <iframe width="100%" height="300px"
                                src="https://www.youtube.com/embed/1xtQPSnmrKI?controls=0">
                                </iframe>   
                                <div class="tease-post__body">
                                    <h2 class="h2"><a href="noticia.php?id=${reg.id}">${reg.titulo}</a></h2>
                                    <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                                    <p class="tease-post__preview">${reg.noticia.substring(0, 500)}&hellip;</p>
                                    <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                                </div>
                            </div>
                        </article>
                    `;
                }else {
                    template += `
                        <article class="tease tease-post" id="tease-${reg.id}">
                            <div class="tease-post__wrap js-masonry-grid-content is-video">
                                <a href="noticia.php?id=${reg.id}" class="tease-post__img">
                                    <img src="http://xrargentina.org/img/noticias/${reg.noticiaImagen}" loading="lazy" />
                                </a>
                                <div class="tease-post__body">
                                    <h2 class="h2"><a href="noticia.php?id=${reg.id}">${reg.titulo}</a></h2>
                                    <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                                    <p class="tease-post__preview">${reg.noticia.substring(0, 500)}&hellip;</p>
                                    <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                                </div>
                            </div>
                        </article>
                    `;
                };
            });
        }
        noticias.innerHTML = template;
        tituloSeccion.innerHTML = 'Todas las notícias';
    })
}




function listarCategorias() {
    fetch('backend/listarCategoria.php').then(res=>res.json()).then(data=>{
        let template = '';
        data.forEach(categoria=>{
            template += `
                <li class=" menu-item menu-item-type-taxonomy menu-item-object-category menu-item-129" style="cursor:pointer">
                    <a onclick="verNoticiaPorCategoria(${categoria.idCategoria})" data-menuanchor="https://rebellion.earth/category/actions/">${categoria.categoria}</a>
                </li>
            `;
        })
        document.getElementById('categorias').innerHTML += template;
    })
}

listarCategorias();

function verNoticiaPorCategoria(idCategoria) {
    document.getElementById('noticias').innerHTML = 'Obteniendo resultados..';
    fetch('backend/listarNoticiasPorCategoria.php?idCategoria='+idCategoria).then(res=>res.json()).then(data=>{
        // console.log(data);
        let template = '';
        if (data.length == 0) {
            template = '<center><div class="alert alert-info">No hay noticias con esa categoria</div></center>'
        }else{
            data.forEach(reg => {
                if (reg.noticiaImagen == 'noDisponible.jpg') {
                    template += `
                        <article class="tease tease-post" id="tease-${reg.id}">
                            <div class="tease-post__wrap js-masonry-grid-content is-video">
                                <div class="tease-post__body">
                                    <h2 class="h2"><a href="noticia.php?id=${reg.id}">${reg.titulo}</a></h2>
                                    <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                                    <p class="tease-post__preview">${reg.noticia.substring(0,500)}&hellip;</p>
        
                                    <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                                </div>
                            </div>
                        </article>
                    `;
                }else if(reg.link != 'null' && reg.link != ''){
                    template +=`
                        <article class="tease tease-post" id="tease-${reg.id}">
                            <div class="tease-post__wrap js-masonry-grid-content is-video">
                                <iframe width="100%" height="300px"
                                src="https://www.youtube.com/embed/1xtQPSnmrKI?controls=0">
                                </iframe>   
                                <div class="tease-post__body">
                                    <h2 class="h2"><a href="noticia.php?id=${reg.id}">${reg.titulo}</a></h2>
                                    <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                                    <p class="tease-post__preview">${reg.noticia.substring(0, 500)}&hellip;</p>
                                    <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                                </div>
                            </div>
                        </article>
                    `;
                }else {
                    template += `
                        <article class="tease tease-post" id="tease-${reg.id}">
                            <div class="tease-post__wrap js-masonry-grid-content is-video">
                                <a href="noticia.php?id=${reg.id}" class="tease-post__img">
                                    <img src="http://xrargentina.org/img/noticias/${reg.noticiaImagen}" loading="lazy" />
                                </a>
                                <div class="tease-post__body">
                                    <h2 class="h2"><a href="noticia.php?id=${reg.id}">${reg.titulo}</a></h2>
                                    <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                                    <p class="tease-post__preview">${reg.noticia.substring(0, 500)}&hellip;</p>
                                    <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                                </div>
                            </div>
                        </article>
                    `;
                };
            });
        }
        document.getElementById('noticias').innerHTML = template;
        document.getElementById('titulo-seccion').innerHTML = 'Noticias sobre "'+data[0].categoria+'"';
        return;
    })
}