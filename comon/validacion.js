    function validar(){
      var nombre = document.getElementById('an-first-name'),
      apellido = document.getElementById('an-last-name'),
      telefono = document.getElementById('an-phone'),
      codigoPostal = document.getElementById('an-postcode'),
      email = document.getElementById('an-email'),
      inputCheck = document.getElementById('an-gdpr-consent');

      var url = window.location.href;

      if (grecaptcha.getResponse() == ""){ 
        alert("Complete el recaptcha");
        return false; 
      } 

      if (!url.includes('?error=1')) { //si incluye es porque viene redireccionado desde backend, entonces no tiene que salir un alert sino un sweetalert.
        if (nombre.value == "" || apellido.value == "" || email.value == "" || telefono.value == "") {
          alert('por favor completa todos los campos');
          return false;
        };
        if (!inputCheck.checked) {
          alert('Acepta el consentimiento');
          return false;
        };
      };
    };

    let divSegundoPaso = document.getElementById('divSegundoPaso');
    let divTercerPaso = document.getElementById('divTercerPaso');
    divSegundoPaso.classList.add('ocultar');
    divTercerPaso.classList.add('ocultar');


    function mostrarSegundoPaso(){
      divSegundoPaso.classList.remove('ocultar');
    }

    function mostrarTercerPaso() {
      divTercerPaso.classList.remove('ocultar');
    }