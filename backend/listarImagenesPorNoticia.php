<?php
    require '../classes/Conexion.php';
    require '../classes/Rebelion.php';
    $rebelion = new Rebelion;
    $data = $rebelion->verImagenesPorNoticia();
    echo $data;
?>