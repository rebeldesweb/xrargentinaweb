<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $listado = $objRebelion->listarEventos();
    echo $listado;
?>