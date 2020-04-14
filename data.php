<?php

  function suscribir()
  {
    $nombre = $_POST['first-name'];
    $apellido = $_POST['last-name'];
    $telefono = $_POST['phone'];
    $cdgPostal = $_POST['postcode'];
    $email = $_POST['email'];
    if ($nombre == "" or $apellido == "" or $email == "") {
      return false;
    };
    return true;
  }

?>
