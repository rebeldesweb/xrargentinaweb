<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $bool = $objRebelion->eliminarEvento();
    if ($bool) {
        echo json_encode('true');
    }else{
        echo json_encode('false');
    }
?>