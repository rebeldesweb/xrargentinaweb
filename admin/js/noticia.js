function getData() {
    fetch('backend/listarNoticia.php')
    .then(res => res.json())
    .then(data=>{
        // console.log(data);
        let noticias = document.getElementById('noticias');
        let template = '';
        data.forEach(reg => {
            template += `
            <tr>
              <td class="text-center">${reg.titulo}</td>
              <td class="text-center">${reg.fecha}</td>
              <td class="text-center">${reg.autor}</td>
              <td class="text-center">
                <a target="blank" id="btn-eliminar" onclick="eliminarNoticia(${reg.id})" class="btn btn-danger">Eliminar<a>
                <a target="blank" id="btn-eliminar" onclick="verNoticiaPorId(${reg.id})" class="btn btn-warning">Modificar<a>
              </td>
            </tr>
            `
        });
        noticias.innerHTML = template;
    })  
}

function eliminarNoticia(id) {
    Swal({
        title: '¿Desea eliminar la noticia?',
        text: "Esta acción no se puede deshacer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#30d685',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmo'
    }).then((result) => {
        if (result.value) {
            fetch('backend/eliminarNoticia.php?id='+id)
            .then(response=>response.json())
            .then(newRes=>{
                if(newRes = 'true'){
                    animationDelete();//funcion de animacion que esta en main.js
                    getData();
                }
            })
        }
    })
}


function verNoticiaPorId(id) {
    // console.log(id);

    //ocultar listado de eventos y mostrar el form para modificar
    let tablaNoticias = document.getElementById('tablaNoticias');
    let formulario = document.getElementById('form-modificar');
    formulario.classList.remove('d-none');
    tablaNoticias.classList.add('d-none');

    fetch('backend/verNoticiaPorId.php?id=' + id)
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes);
        let form = document.getElementById('formModificarNoticia');
        let template = '';
        newRes.forEach(reg => {
            template += `
            <br>
            <input type="hidden" name="id" value="${reg.id}">
            Título:
            <input type="text" name="titulo" value="${reg.titulo}" class="form-control mt-3" required>
            <br>
            Fecha:
            <input type="text" name="fecha" value="${reg.fecha}" class="form-control mt-3" required>
            <hr>
            <input type="text" name="autor" value="${reg.autor}" class="form-control mt-3" required>
            <textarea name="noticia" class="form-control mt-3" cols="30" rows="30" required>${reg.noticia}</textarea>
            Imagen:
            <br>
            <img src="../img/noticias/${reg.noticiaImagen}" alt="">
            <input type="file" name="noticiaImagen" class="mt-1"/>
            <br>
            <center>
                <input type="submit" class="btn btn-info mt-3" value="Modificar noticia">
            </center>
            `
        });
        form.innerHTML = template;
    })
}

function ocultarFormularioModificar() {
    let tablaNoticias = document.getElementById('tablaNoticias');
    let formulario = document.getElementById('form-modificar');
    formulario.classList.add('d-none');
    tablaNoticias.classList.remove('d-none');
    getData();//llamo a la funcion de getData para obtener la tabla actualizada con la modificacion
}

function ocultarFormularioAgregar() {
    let tablaNoticias = document.getElementById('tablaNoticias');
    let divFormulario = document.getElementById('form-agregar');
    let formulario = document.getElementById('formAgregarNoticia');
    let alert = document.getElementById('alert-success');
    alert.classList.add('d-none');
    formulario.reset(); //reseteo los campos del form para que si luego quiero agregar otro evento, los inputs esten vacios.
    divFormulario.classList.add('d-none');
    tablaNoticias.classList.remove('d-none');
    getData();//llamo a la funcion de getData para obtener la tabla actualizada con lo que agregue
}

function mostrarFormularioAgregar() {
    //ocultar listado de eventos y mostrar el form para agregar
    let tablaNoticias = document.getElementById('tablaNoticias');
    let divFormulario = document.getElementById('form-agregar');
    let formulario = document.getElementById('formAgregarNoticia');
    formulario.classList.remove('d-none');
    divFormulario.classList.remove('d-none');
    tablaNoticias.classList.add('d-none');
}

getData();

//################### modificar noticia ###################//

let formulario = document.getElementById('formModificarNoticia');
formulario.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formulario);
    fetch('backend/modificarNoticia.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes)
        if (newRes) {
            template = `<div class="alert alert-info">Se ha modificado la noticia con éxito</div>`;
            formulario.innerHTML = template;
        }
    })
})


//################### agregar noticia ###################//

let formularioAgregar = document.getElementById('formAgregarNoticia');
formularioAgregar.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formularioAgregar);
    fetch('backend/agregarNoticia.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes) {
            alert = document.getElementById('alert-success');
            alert.classList.remove('d-none');
            formularioAgregar.classList.add('d-none');
        }
    })
})

