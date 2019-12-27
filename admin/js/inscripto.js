function getData() {
    fetch('backend/listarInscripto.php')
    .then(res => res.json())
    .then(data=>{
        // console.log(data);
        let inscriptos = document.getElementById('inscriptos');
        let template = '';
        data.forEach(reg => {
            template += `
            <tr>
              <td class="text-center">${reg.id}</td>
              <td class="text-center">${reg.nombre}</td>
              <td class="text-center">${reg.apellido}></td>
              <td class="text-center">${reg.email}</td>
              <td class="text-center">${reg.integracionOK}</td>
              <td class="text-center">${reg.ADNVOK}</td>
              <td class="text-center">${reg.organizacion}</td>
              <td class="text-center">${reg.sendEmail}</td>
              <td class="text-center">${reg.fecha}</td>
              <td class="text-center">
                <a target="blank" id="btn-eliminar" onclick="deleteInscripto(${reg.id})" class="btn btn-danger">Eliminar</a>
              </td>
            </tr>
            `
        });
        inscriptos.innerHTML = template;
    })  
}

function deleteInscripto(id) {
    Swal({
        title: '¿Desea eliminar al inscripto?',
        text: "Esta acción no se puede deshacer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#30d685',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmo'
    }).then((result) => {
        if (result.value) {
            fetch('backend/eliminarInscripto.php?id='+id)
            .then(response=>response.json())
            .then(newRes=>{
                if(newRes = 'eliminado'){
                    animationDelete();//funcion de animacion que esta en main.js
                    getData();
                }
            })
        }
    })
}


function updateInscripto(id) {
    console.log(id);
}

getData();


//#########################################//

// formulario de busqueda

let formulario = document.getElementById('formSearch');
formulario.addEventListener('submit',event=>{
    event.preventDefault();
    let data  = new FormData(formulario);
    fetch('backend/verInscriptoPorId.php',{
        method: 'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        // console.log(newRes);
        cantidad = newRes.length;
        // console.log(cantidad);
        let inscriptos = document.getElementById('inscriptos');
        let table = document.getElementById('table'); //capturo la tabla para ocultar si no hay registros que coincidan con la busqueda. REVISAR IGUAL
        let reporting = document.getElementById('reporting');
        let template = '';
        if (cantidad >= 1) {
            table.style.visibility = 'visible';
            reporting.style.visibility = 'hidden';
            newRes.forEach(reg => {
                template += `
                <tr>
                  <td class="text-center">${reg.id}</td>
                  <td class="text-center">${reg.nombre}</td>
                  <td class="text-center">${reg.apellido}></td>
                  <td class="text-center">${reg.email}</td>
                  <td class="text-center">${reg.integracionOK}</td>
                  <td class="text-center">${reg.ADNVOK}</td>
                  <td class="text-center">${reg.organizacion}</td>
                  <td class="text-center">${reg.sendEmail}</td>
                  <td class="text-center">${reg.fecha}</td>
                  <td class="text-center">
                    <a target="blank" id="btn-eliminar" onclick="deleteInscripto(${reg.id})" class="btn btn-danger">Eliminar</a>
                    
                  </td>
                </tr>
                `
            });
            inscriptos.innerHTML = template;   
        }else{
            template += '<div class="alert alert-info text-center">No se encontraron resultados con la busqueda</div>';
            reporting.style.visibility = 'visible';
            table.style.visibility = 'hidden';
            reporting.innerHTML = template; 
        }
    })
})

