

function getInscriptos(tipo){
    let optionBody = document.getElementById('optionBody');
    let tablaInscriptos = document.getElementById('tablaInscriptos');
    fetch('backend/listarColaboradorPorTipo.php?tipo='+tipo)
    .then(res => res.json())
    .then(data=>{
        // console.log(data);
        let inscriptos = document.getElementById('inscriptos');
        let template = '';
        data.forEach(reg => {
            template += `
            <tr>
              <td class="text-center">${reg.nombre}</td>
              <td class="text-center">${reg.apellido}</td>
              <td class="text-center">${reg.email}</td>
              <td class="text-center">${reg.colaboracion}</td>
              <td class="text-center">${reg.telegram}</td>
              <td class="text-center">
                <a target="blank" id="btn-modificar" href="mailto:${reg.email}" class="btn btn-info">Contactarme</a>
                <a target="blank" id="btn-modificar-telegram" onclick="habilitarFormularioModificarColaborador('${reg.colaboracion}',${reg.idInscripto})" class="btn btn-warning">Modificar</a>
              </td>
            </tr>
            `
        });
        optionBody.classList.toggle('d-none');
        tablaInscriptos.classList.toggle('d-none');
        inscriptos.innerHTML = template;
    })  
}

let btnBack = document.getElementById('btnBack');
btnBack.addEventListener('click', ()=>{
    optionBody.classList.toggle('d-none');
    tablaInscriptos.classList.toggle('d-none');
})


function habilitarFormularioModificarColaborador(tipo,id) {
  let formEditarColaborador = document.getElementById('tablaColaboradoresModificar');
  tablaInscriptos.classList.toggle('d-none');
  formEditarColaborador.classList.remove('d-none');
  fetch('backend/listarColaboradorPorTipoAndId.php?tipo='+tipo+'&id='+id)
  .then(res=>res.json())
  .then(newRes=>{
    // console.log(newRes);
    let formModificarColaborador = document.getElementById('form-modificar-colaborador');
    let template = '';
    newRes.forEach(colaborador => {
      template += `
      <!-- id oculto -->
      <input type="hidden" name="id" value="${colaborador.idInscripto}">
      <br>
      <header class="header">
          <h3 class="text-center ">${colaborador.nombre} ${colaborador.apellido}</h3>
      </header>

      <div class="container mt-3">
          <div class="container-fluid">
              <center><span class="text-muted">DATOS GENERALES</span></center>
              <hr>
              <div class="row">
                  <div class="col-3">
                      <p class="text-center lbl">Nombre:</p>
                      <p class="text-center text-muted">${colaborador.nombre}</p>
                  </div>
                  <div class="col-3">
                      <p class="text-center lbl">Apellido:</p>
                      <p class="text-center text-muted">${colaborador.apellido}</p>
                  </div>
                  <div class="col-3">
                      <p class="text-center lbl">Colaboracion</p>
                      <p class="text-center text-muted">${colaborador.colaboracion}</p>
                  </div>
                  <div class="col-3">
                      <p class="text-center lbl">Email</p>
                      <p class="text-center text-muted">${colaborador.email}</p>
                  </div>
                  <div class="col-12">
                      <p class="text-center lbl">Telegram:</p>
                      <input type="text" name="telegram" class="form-control" value="${colaborador.telegram}">
                  </div>
              </div>
          </div>
      </div>
      <br><br>
      <center><input type="submit" class="btn btn-warning" value="Modificar"></center>
      `;
    });
    formModificarColaborador.innerHTML = template;
  })
}

// MODIFICAR COLABORADOR

let formModificarColaborador = document.getElementById('form-modificar-colaborador');
formModificarColaborador.addEventListener('submit',e=>{
    e.preventDefault();
    let data = new FormData(formModificarColaborador);
    fetch('backend/modificarColaborador.php',{
        method:'POST',
        body: data
    })
    .then(res=>res.json())
    .then(newRes=>{
        if (newRes) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Colaborador modificado',
            showConfirmButton: false,
            timer: 1500
          })
        }else{
            alert('Problemas al modificar')
        }
    })
})

