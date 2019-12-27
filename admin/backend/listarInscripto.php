<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $listado = $objRebelion->listarInscripto();
    echo $listado;
?>