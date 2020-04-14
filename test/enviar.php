<?php
  require 'classes/Conexion.php';
  require 'classes/Rebelion.php';
  $objRebelion = new Rebelion();
  $bool = $objRebelion->agregarInscripto();
  if ($bool) {
    header('location:old.html?suscribido');
  }else {
    header('location:old.html');
  }

  // $conexion = mysqli_connect('69.175.67.50', 'laciudad_xrargentina', 'Rebeldesarg1', 'laciudad_xrargentina');
  // if ($conexion) {
  //   echo "Conectado";
  // }else {
  //   echo "problemas" . mysqli_error($conexion);
  // }


  // header('location: old.html');

?>
