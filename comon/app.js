window.onload = () =>{
    fetch('backend/getEvents.php')
    .then(response => response.json())
    .then(newRes =>{
        let template = '';
        // let divEvento = document.getElementById('divEventos');
        // if (newRes.length==0){
        //   divEvento.style.visibility = 'hidden';
        // } REVISAR PARA CUANDO NO HAYA EVENTOS
        console.log(newRes.length);
        newRes.forEach(reg => {
            template += `
            <li>
                <article class="tease tease-event is-multi-day tease-event--light" id="tease-4818">
                  <a href="eventoSingle.php?id=${reg.id}">
                    <div class="tease-event__img" style="background-image: url('img/eventos/${reg.imgEvento}'); background-position: center;"></div>
                      <div class="tease-event__date-small">
                        <div>
                          <span class="day">${reg.numeroEvento}</span>
                          <span class="month">${reg.mesEvento}</span>
                        </div>
                        <div class="divider">-</div>
                      </div>
                      <div class="tease-event__body">
                        <h2>${reg.nombreEvento}</h2>
                        <div class="tease-event__details">
                          <div>
                            <div class="tease-event__date-long">
                              <div>
                                <strong>Desde:</strong><br />
                                ${reg.diaEventoInicial}<br />
                                <span class="start">${reg.horarioInicialEvento}</span>
                              </div>
                              <div class="divider">-</div>
                              <div>
                                <strong>Hasta:</strong><br />
                                ${reg.diaEventoFinal}<br />
                                <span>${reg.horarioFinalEvento}</span>
                              </div>
                            </div>
                            <div class="tease-event__location">
                              ${reg.lugarEvento}
                            </div>
                          </div>
                          <div class="tease-event__btn">
                            <span class="btn btn--primary-dark">Ver más</span>
                          </div>
                        </div>
                      </div>
                  </a>
                </article>
            </li> <!--fin caja evento -->
            `
        });
        let contenedorEvento = document.getElementById('contenedorEvento');
        contenedorEvento.innerHTML = template;
    })
}

