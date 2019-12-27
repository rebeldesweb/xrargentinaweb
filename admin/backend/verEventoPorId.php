<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $registro = $objRebelion->verEventoPorId();
    echo $registro;
?>