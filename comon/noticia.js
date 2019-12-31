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
