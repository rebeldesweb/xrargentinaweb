let noticias = document.getElementById('noticias');
fetch('backend/listarNoticias.php')
.then(res=>res.json())
.then(newRes=>{
    let template = '';
    // console.log(newRes);
    newRes.forEach(reg => {
        template += `
        <center>
            <article class="tease tease-post" style="margin-top:10px" id="tease-10689">
                <div class="tease-post__wrap js-masonry-grid-content is-video">
                    <div class="tease-post__body">
                        <h2 class="h2">
                            <a href="noticia.php?id=${reg.id}">${reg.titulo}</a>
                        </h2>
                        <p class="tease-post__meta">${reg.fecha} Por ${reg.autor}</p>
                        <p class="tease-post__preview" id="noticiaLong">${reg.noticia}</p>
                        
                    </div>
                </div>
            </article>
        </center>
        `
    });
    // console.log(newRes.length);
    if (newRes.length == 0) {
        template = '<center><div class="alert alert-info">No hay noticias cargadas en este momento</div></center>'
    }
    noticias.innerHTML = template;
})

