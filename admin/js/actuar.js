const tablaAcciones = document.getElementById('tablaAcciones');
const tablaFilas = document.getElementById('filaAcciones');
const divFormulario = document.getElementById('form-agregar');
const formulario = document.getElementById('formAgregarAccion');
const formModificarDiv = document.getElementById('form-modificar');
const formularioModificar = document.getElementById('formModificarAccion');
const alertSuccess = document.getElementById('alert-success');


function getAccion(){
    fetch('backend/listarAccion.php')
    .then(res=>res.json())
    .then(data=>{
        let template = '';
        data.forEach(accion => {
            template += `
                <tr>
                <td class="text-center">${accion.titulo}</td>
                <td class="text-center">${accion.parrafo}</td>
                <td class="text-center">${accion.imagen}</td>
                <td class="text-center">${accion.imgPosicion}</td>
                <td class="text-center">${accion.link}</td>
                <td class="text-center">
                    <a target="blank" id="btn-modificar" onclick="verEventoPorId(${accion.id})" class="btn btn-info">Modificar</a>
                    <a target="blank" id="btn-eliminar-accion" onclick="eliminarAccion(${accion.id})" class="btn btn-danger">Eliminar</a>
                </td>
                </tr>
            `;
        });
        tablaFilas.innerHTML = template;
        return;
    })
}

getAccion();

function verEventoPorId(id) {
    // console.log(id);

    //ocultar listado de eventos y mostrar el form para modificar
    formModificarDiv.classList.remove('d-none');
    tablaAcciones.classList.add('d-none');

    fetch('backend/verAccionPorId.php?id=' + id)
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes);
        let template = '';
        newRes.forEach(reg => {
            template += `
                <br>
                <input type="text" name="titulo" placeholder="Titulo" class="form-control mt-3" required value="${reg.titulo}">
                <br>
                <label for="">Descipción</label>
                <textarea name="parrafo" class="form-control" cols="15" rows="5">${reg.parrafo}</textarea>
                <hr>
                <label class="mt-3">imagen de la acción:</label>
                <img src="../img/actuarAhora/${reg.imagen}" alt="" width="50%" height="300px">
                <input type="file" name="imagen" class="mt-1"/>
                <br><br><br>
                <select name="imgPosicion" class="form-control">
                    <option value="${reg.imgPosicion}">${reg.imgPosicion}</option>
                    <option value="derecha">Derecha</option>
                    <option value="izquierda">Izquierda</option>
                </select>
                <input type="text" name="link" class="form-control mt-3" placeholder="URL de la accion" required value="${reg.link}">
                <input type="hidden" name="id" value="${reg.id}">
                <input type="hidden" name="imagenPrevia" value="${reg.imagen}">
                <br>
                <center>
                    <input type="submit" class="btn btn-info mt-3" value="Modificar Acción">
                </center>
            `
        });
        formularioModificar.innerHTML = template;
    })
}

function eliminarAccion(id) {
    Swal({
        title: '¿Desea eliminar la acción?',
        text: "Esta acción no se puede deshacer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#30d685',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmo'
    }).then((result) => {
        if (result.value) {
            fetch('backend/eliminarAccion.php?id='+id)
            .then(response=>response.json())
            .then(newRes=>{
                if(newRes = 'true'){
                    animationDelete();//funcion de animacion que esta en main.js
                    getAccion();
                }
            })
        }
    })
}

function ocultarFormularioModificar() {
    formModificarDiv.classList.add('d-none');
    tablaAcciones.classList.remove('d-none');
    getAccion();//llamo a la funcion de getData para obtener la tabla actualizada con la modificacion
}


function mostrarFormularioAgregar() {
    //ocultar listado de eventos y mostrar el form para agregar
    formulario.classList.remove('d-none');
    divFormulario.classList.remove('d-none');
    tablaAcciones.classList.add('d-none');
}

function ocultarFormularioAgregar() {
    formulario.reset(); //reseteo los campos del form para que si luego quiero agregar otro evento, los inputs esten vacios.
    divFormulario.classList.add('d-none');
    tablaAcciones.classList.remove('d-none');
    getAccion();//llamo a la funcion de getData para obtener la tabla actualizada con lo que agregue
}


//################### modificar accion ###################//

let formularioModificarAccion = document.getElementById('formModificarAccion');
formularioModificarAccion.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formularioModificarAccion);
    fetch('backend/modificarAccion.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes) {
            template = `<div class="alert alert-info">Se ha modificado la acción con éxito</div>`;
            formularioModificarAccion.innerHTML = template;
        }
    })
})


//################### agregar evento ###################//
formulario.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formulario);
    fetch('backend/agregarAccion.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes) {
            alertSuccess.classList.remove('d-none');
            formulario.classList.add('d-none');
        }
    })
})