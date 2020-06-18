<?php
    require '../classes/Conexion.php';
    require '../classes/Rebelion.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->listarNoticiaPorCategoria();
    echo $data;
?>