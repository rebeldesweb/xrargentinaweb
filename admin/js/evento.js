function getData() {
    fetch('backend/listarEvento.php')
    .then(res => res.json())
    .then(data=>{
        // console.log(data);
        let eventos = document.getElementById('eventos');
        let template = '';
        data.forEach(reg => {
            template += `
            <tr>
              <td class="text-center">${reg.nombreEvento}</td>
              <td class="text-center">${reg.lugarEvento}</td>
              <td class="text-center">${reg.diaEventoInicial}</td>
              <td class="text-center">${reg.horarioInicialEvento}</td>
              <td class="text-center">${reg.diaEventoFinal}</td>
              <td class="text-center">${reg.mesEvento}</td>
              <td class="text-center">
                <a target="blank" id="btn-eliminar" onclick="eliminarEvento(${reg.id})" class="btn btn-danger">Eliminar<a>
                <a target="blank" id="btn-eliminar" onclick="verEventoPorId(${reg.id})" class="btn btn-warning">Modificar<a>
              </td>
            </tr>
            `
        });
        document.querySelector('.container__slider').classList.add('d-none');
        eventos.innerHTML = template;
    })  
}

function eliminarEvento(id) {
    Swal({
        title: '¿Desea eliminar el evento?',
        text: "Esta acción no se puede deshacer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#30d685',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmo'
    }).then((result) => {
        if (result.value) {
            fetch('backend/eliminarEvento.php?id='+id)
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


function verEventoPorId(id) {
    // console.log(id);

    //ocultar listado de eventos y mostrar el form para modificar
    let tablaEventos = document.getElementById('tablaEventos');
    let formulario = document.getElementById('form-modificar');
    formulario.classList.remove('d-none');
    tablaEventos.classList.add('d-none');

    fetch('backend/verEventoPorId.php?id=' + id)
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes);
        let form = document.getElementById('formModificarEvento');
        let template = '';
        newRes.forEach(reg => {
            template += `
            <br>
            Desde:
            <input type="text" name="diaEventoInicial" class="form-control mt-3" value="${reg.diaEventoInicial}" required>
            <input type="text" name="horarioInicialEvento" class="form-control mt-3" value="${reg.horarioInicialEvento}" required>
            <input type="hidden" name="id" value="${reg.id}" required>
            <br>
            Hasta:
            <input type="text" name="diaEventoFinal" class="form-control mt-3" value="${reg.diaEventoFinal}" required>
            <input type="text" name="horarioFinalEvento" class="form-control mt-3" value="${reg.horarioFinalEvento}" required>
            <hr>
            <input type="text" name="nombreEvento" class="form-control mt-3" value="${reg.nombreEvento}" required>
            <input type="text" name="lugarEvento" class="form-control mt-3" value="${reg.lugarEvento}" required>
            <textarea name="descripcion" class="form-control mt-3" cols="30" rows="10" required>${reg.descripcion}</textarea>
            <label class="mt-3">imagen del evento:</label>
            <img src="../img/eventos/${reg.imgEvento}" alt="">
            <input type="file" name="imgEvento" class="mt-1"/>
            <input type="text" name="numeroEvento" class="form-control mt-3" value="${reg.numeroEvento}" required>
            <input type="text" name="mesEvento" class="form-control mt-3" value="${reg.mesEvento}" required>
            <br>
            <center>
                <input type="submit" class="btn btn-info mt-3" value="Modificar Evento">
            </center>
            `
        });
        form.innerHTML = template;
    })
}

function ocultarFormularioModificar() {
    let tablaEventos = document.getElementById('tablaEventos');
    let formulario = document.getElementById('form-modificar');
    formulario.classList.add('d-none');
    tablaEventos.classList.remove('d-none');
    getData();//llamo a la funcion de getData para obtener la tabla actualizada con la modificacion
}

function ocultarFormularioAgregar() {
    let tablaEventos = document.getElementById('tablaEventos');
    let divFormulario = document.getElementById('form-agregar');
    let formulario = document.getElementById('formAgregarEvento');
    let alert = document.getElementById('alert-success');
    alert.classList.add('d-none');
    formulario.reset(); //reseteo los campos del form para que si luego quiero agregar otro evento, los inputs esten vacios.
    divFormulario.classList.add('d-none');
    tablaEventos.classList.remove('d-none');
    getData();//llamo a la funcion de getData para obtener la tabla actualizada con lo que agregue
}

function mostrarFormularioAgregar() {
    //ocultar listado de eventos y mostrar el form para agregar
    let tablaEventos = document.getElementById('tablaEventos');
    let divFormulario = document.getElementById('form-agregar');
    let formulario = document.getElementById('formAgregarEvento');
    formulario.classList.remove('d-none');
    divFormulario.classList.remove('d-none');
    tablaEventos.classList.add('d-none');
}

getData();

//################### modificar evento ###################//

let formulario = document.getElementById('formModificarEvento');
formulario.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formulario);
    fetch('backend/modificarEvento.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes) {
            template = `<div class="alert alert-info">Se ha modificado el evento con éxito</div>`;
            formulario.innerHTML = template;
        }
    })
})


//################### agregar evento ###################//

let formularioAgregar = document.getElementById('formAgregarEvento');
formularioAgregar.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formularioAgregar);
    fetch('backend/agregarEvento.php',{
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

