let div = document.getElementById('padreItemActuarAhora');
fetch('backend/listarAccion.php')
.then(res=>res.json())
.then(data=>{
    let template = '';
    data.forEach(accion => {
        if (accion.imagen == 'noDisponible.jpg') {
            template += `
            <div class="numbered-list-jumbo__body type" >
                <h2 id="tell-the-truth" class="demands-section-heading"><a href="${accion.link}" target="new">${accion.titulo}</a> </h2>
                <div class="itemActuarAhora">
                    <div class="textoNoticiaSinFoto">
                        <p>${accion.parrafo}<br></p>
                    </div>
                </div>
            </div>
            <br>
            `;
        }else{
            if (accion.imgPosicion=='izquierda') {
                template += `
                    <div class="numbered-list-jumbo__body type" >
                        <h2 id="tell-the-truth" class="demands-section-heading"><a href="${accion.link}" target="new">${accion.titulo}</a> </h2>
                        <div class="itemActuarAhora">
                            <div class="imagenNoticia left">
                                <img src="img/actuarAhora/${accion.imagen}" class="img-fluid" alt="">
                            </div>
                            <div class="textoNoticia">
                                <p>${accion.parrafo}<br></p>
                            </div>
                        </div>
                    </div>
                    <br>
                `;
            }else{
                template += `
                    <div class="numbered-list-jumbo__body type" >
                        <h2 id="tell-the-truth" class="demands-section-heading"><a href="${accion.link}" target="new">${accion.titulo}</a> </h2>
                        <div class="itemActuarAhora">
                            <div class="textoNoticia">
                                <p>${accion.parrafo}<br>
                                </p>
                            </div>
                            <div class="imagenNoticia right">
                                <img src="img/actuarAhora/${accion.imagen}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                    <br>
                `;
            };
        }
    });
    div.innerHTML = template;
})