let optionBody = document.getElementById('optionBody');
let tablaInscriptos = document.getElementById('tablaInscriptos');
function getInscriptos(tipo){
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
              <td class="text-center">${reg.apellido}></td>
              <td class="text-center">${reg.email}</td>
              <td class="text-center">${reg.colaboracion}</td>
              <td class="text-center">
                <a target="blank" id="btn-modificar" href="mailto:${reg.email}" class="btn btn-warning">Contactarme</a>
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
