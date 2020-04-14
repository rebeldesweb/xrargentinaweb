<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $bool = $objRebelion->eliminarInscripto();
    if ($bool) {
        echo json_encode('eliminado');
    }else{
        echo json_encode('false');
    }
?>