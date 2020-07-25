function getData() {
    fetch('backend/listarNoticia.php')
    .then(res => res.json())
    .then(data=>{
        console.log(data);
        let noticias = document.getElementById('noticias');
        let template = '';
        data.forEach(reg => {
            template += `
            <tr>
              <td class="text-center">${reg.titulo}</td>
              <td class="text-center">${reg.categoria}</td>
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

function getCategorias(select,agregar=false,idCategoria=null) {
    let template = '';
    fetch('backend/categoriasNoticia/listarCategoria.php').then(res=>res.json()).then(response=>{
        console.log(response);
        if(!agregar){
            response.forEach(categoria=>{
                if(categoria.idCategoria != idCategoria){
                    template += `
                        <option value="${categoria.idCategoria}">${categoria.categoria}</option>
                    `;
                }
            })
            select.innerHTML += template;
            return;
        }
        response.forEach(categoria => {
            template += `
                <option value="${categoria.idCategoria}">${categoria.categoria}</option>
            `;
        });
        select.innerHTML = template;
        return;
    });
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
        console.log(newRes);
        let form = document.getElementById('formModificarNoticia');
        let template = '';
        newRes.forEach(reg => {
            template += `
            <br>
            <input type="hidden" name="id" value="${reg.id}">
            Título:
            <input type="text" name="titulo" value="${reg.titulo}" class="form-control mt-3" required>
            <br>
            Categoria:
            <select class="form-control" name="idCategoria" id="categoria">
                <option value="${reg.idCategoria}">${reg.categoria}</option>
            </select>
            <br>
            Fecha:
            <input type="text" name="fecha" value="${reg.fecha}" class="form-control mt-3" required>
            <hr>
            <input type="text" name="autor" value="${reg.autor}" class="form-control mt-3" required>
            <textarea name="noticia" class="form-control mt-3" cols="30" rows="30" required>${reg.noticia}</textarea>
            Imagen:
            <br>
            <img class="img-fluid w-100" src="../img/noticias/${reg.noticiaImagen}" alt="">
            <input type="file" name="noticiaImagen" class="mt-1"/>
            <br>
            <br>
            Url Video:
            <br>
            <textarea class="form-control w-100 mt-1" rows="5" name="link">
                ${(reg.link == 'null' || reg.link == null)?reg.link = '':reg.link = reg.link}
            </textarea>
            <br>
            <center>
                <input type="submit" class="btn btn-info mt-3" value="Modificar noticia">
            </center>
            `
        });
        form.innerHTML = template;
        let selectCategoria = document.getElementById('categoria');
        getCategorias(selectCategoria,false,newRes[0].idCategoria);
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
    select = document.getElementById('categoriaAgregar');
    getCategorias(select,true);
}

getData();

//################### modificar noticia ###################//

let formulario = document.getElementById('formModificarNoticia');
formulario.addEventListener('submit', event=>{
    event.preventDefault();
    document.getElementById('slider').classList.toggle('d-none');
    let data = new FormData(formulario);
    fetch('backend/modificarNoticia.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes)
        if (newRes) {
            document.getElementById('slider').classList.toggle('d-none');
            template = `<div class="alert alert-info">Se ha modificado la noticia con éxito</div>`;
            formulario.innerHTML = template;
        }
    })
})


//################### agregar noticia ###################//

let formularioAgregar = document.getElementById('formAgregarNoticia');
formularioAgregar.addEventListener('submit', event=>{
    event.preventDefault();
    document.getElementById('slider').classList.toggle('d-none');
    let data = new FormData(formularioAgregar);
    fetch('backend/agregarNoticia.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes) {
            document.getElementById('slider').classList.toggle('d-none');
            alert = document.getElementById('alert-success');
            alert.classList.remove('d-none');
            formularioAgregar.classList.add('d-none');
        }
    })
})

