let noticias = document.getElementById('noticias');
fetch('backend/listarNoticias.php')
.then(res=>res.json())
.then(newRes=>{
    // console.log(newRes);
    let template = '';
    newRes.forEach(reg => {
        if (reg.noticiaImagen == 'noDisponible.jpg') {
            template += `
            <article class="tease tease-post" id="tease-${reg.id}" style="height:auto;">
                <div class="tease-post__wrap js-masonry-grid-content is-video">
                    <div class="tease-post__body">
                        <h2 class="h2">
                            <a href="noticia.php?id=${reg.id}">${reg.titulo}</a>
                        </h2>
                        <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                        <p class="tease-post__preview" id="cuerpoNoticia">${reg.noticia.substring(0, 500)}&hellip;</p>
                        <a href="noticia.php?id=${reg.id}" class="btn btn--primary-dark">Ver nota completa</a>
                    </div>
                </div>
            </article>
            `;
        }else{
            template += `
            <article class="tease tease-post" id="tease-${reg.id}">
                <div class="tease-post__wrap js-masonry-grid-content is-video">
                    <a href="noticia.php?id=${reg.id}" class="tease-post__img">
                        <img src="img/noticias/${reg.noticiaImagen}" loading="lazy" />
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
    // console.log(newRes.length);
    if (newRes.length == 0) {
        template = '<center><div class="alert alert-info">No hay noticias cargadas en este momento</div></center>'
    }
    noticias.innerHTML = template;
})
