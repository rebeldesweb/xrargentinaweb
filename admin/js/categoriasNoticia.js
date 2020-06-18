function getData() {
    fetch('backend/categoriasNoticia/listarCategoria.php')
    .then(res => res.json())
    .then(data=>{
        // console.log(data);
        let categorias = document.getElementById('categorias');
        let template = '';
        data.forEach(reg => {
            template += `
            <tr>
              <td class="text-center">${reg.idCategoria}</td>
              <td class="text-center">${reg.categoria}</td>
              <td class="text-center">
                <a target="blank" id="btn-eliminar" onclick="eliminarCategoria(${reg.idCategoria})" class="btn btn-danger">Eliminar<a>
                <a target="blank" id="btn-eliminar" onclick="verCategoriaPorId(${reg.idCategoria})" class="btn btn-warning">Modificar<a>
              </td>
            </tr>
            `
        });
        categorias.innerHTML = template;
    })  
}

function eliminarCategoria(id) {
    Swal({
        title: '¿Desea eliminar la categoria?',
        text: "Esta acción no se puede deshacer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#30d685',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmo'
    }).then((result) => {
        if (result.value) {
            fetch('backend/categoriasNoticia/eliminarCategoria.php?idCategoria='+id)
            .then(response=>response.json())
            .then(newRes=>{
                if(newRes.status == 200){
                    animationDelete();//funcion de animacion que esta en main.js
                    getData();
                }
            })
        }
    })
}


function verCategoriaPorId(id) {
    // console.log(id);

    //ocultar listado de eventos y mostrar el form para modificar
    let tablaCategorias = document.getElementById('tablaCategorias');
    let formulario = document.getElementById('form-modificar');
    formulario.classList.remove('d-none');
    tablaCategorias.classList.add('d-none');

    fetch('backend/categoriasNoticia/verCategoriaPorId.php?idCategoria=' + id)
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes);
        let form = document.getElementById('formModificarCategoria');
        let template = '';
        newRes.forEach(reg => {
            template += `
            <br>
            <input type="hidden" name="idCategoria" value="${reg.idCategoria}">
            Categoria:
            <input type="text" name="categoria" value="${reg.categoria}" class="form-control mt-3" required>
            <br>
            <center>
                <input type="submit" class="btn btn-info mt-3" value="Modificar Categoria">
            </center>
            `
        });
        form.innerHTML = template;
        return;
    })
}

function ocultarFormularioModificar() {
    let tablaCategorias = document.getElementById('tablaCategorias');
    let formulario = document.getElementById('form-modificar');
    formulario.classList.add('d-none');
    tablaCategorias.classList.remove('d-none');
    getData();//llamo a la funcion de getData para obtener la tabla actualizada con la modificacion
}

function ocultarFormularioAgregar() {
    let tablaCategorias = document.getElementById('tablaCategorias');
    let divFormulario = document.getElementById('form-agregar');
    let formulario = document.getElementById('formAgregarCategoria');
    let alert = document.getElementById('alert-success');
    alert.classList.add('d-none');
    formulario.reset();
    divFormulario.classList.add('d-none');
    tablaCategorias.classList.remove('d-none');
    getData();
}

function mostrarFormularioAgregar() {
    //ocultar listado de eventos y mostrar el form para agregar
    let tablaCategorias = document.getElementById('tablaCategorias');
    let divFormulario = document.getElementById('form-agregar');
    let formulario = document.getElementById('formAgregarCategoria');
    formulario.classList.remove('d-none');
    divFormulario.classList.remove('d-none');
    tablaCategorias.classList.add('d-none');
}

getData();

//################### modificar categoria ###################//

let formulario = document.getElementById('formModificarCategoria');
formulario.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formulario);
    fetch('backend/categoriasNoticia/modificarCategoria.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes)
        if (newRes.status == 200) {
            template = `<div class="alert alert-info">${newRes.info}</div>`;
            formulario.innerHTML = template;
        }
    })
})


//################### agregar categoria ###################//

let formularioAgregar = document.getElementById('formAgregarCategoria');
formularioAgregar.addEventListener('submit', event=>{
    event.preventDefault();
    let data = new FormData(formularioAgregar);
    fetch('backend/categoriasNoticia/agregarCategoria.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes.status == 200) {
            alert = document.getElementById('alert-success');
            alert.classList.remove('d-none');
            formularioAgregar.classList.add('d-none');
        }
    })
})

