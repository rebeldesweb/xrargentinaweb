<?php
    require '../classes/Conexion.php';
    require '../classes/Actuar.php';
    $actuar = new ActuarAhora;
    $data = $actuar->listarAccion();
    echo $data;
?>