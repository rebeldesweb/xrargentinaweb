<?php
    require 'config/config.php';
    $objRebelion = new Rebelion();
    $bool = $objRebelion->modificarInscripto();
    if ($bool) {
        header('location: ../adminInscriptos.php');
    }
?>